#include <iostream>
#include <vector>
#include <string>
#include <cmath>

using namespace std;

double rotational_delay(double speed, double seek_time, double bytes_per_record, double bytes_per_sector) {
	double minRD = 0;
	double maxRD = 1 / (speed / (60000));
	double avgRD = (maxRD + minRD) / 2;
	double total_time_per_track = (seek_time + avgRD + maxRD);

	cout << "1." << endl;
	cout << "	Minimum Rotational Delay: " << minRD << " ms" << endl;
	cout << "	Maximum Rotational Delay: " << maxRD << " ms" << endl;
	cout << "	Average Rotational Delay: " << avgRD << " ms" << endl;
	cout << "	Transfer Time: " << maxRD << " ms" << endl;
	if (bytes_per_sector > bytes_per_record) {
		cout << "2." << endl;
		cout << "	# of Records per Sector: " << (bytes_per_sector / bytes_per_record) << endl;
		cout << endl;
	}
	else {
		cout << "2." << endl;
		cout << "	# of Records per Sector: " << (bytes_per_record / bytes_per_sector) << endl;
		cout << endl;
	}
	cout << "4." << endl;
	cout << "	Total Time per Track: " << total_time_per_track << " ms" << endl;

	return total_time_per_track;
}

void total_time(double records, double bytes_per_record, double bytes_per_sector, double sectors_per_track, double sectors_per_cluster, double speed, double seek_time) {
	double minRD = 0;
	double maxRD = 1 / (speed / (60000));
	double avgRD = (maxRD + minRD) / 2;
	double total_time_per_track = (seek_time + avgRD + maxRD);
	double transfer_time = maxRD;
	double tracks = ((records * bytes_per_record) / (bytes_per_sector * sectors_per_track));
	double Total_time_Reading_Cluster = (sectors_per_cluster * (transfer_time / sectors_per_track));

	cout << "	Total # of Tracks: " << tracks << endl;
	cout << "3." << endl;
	cout << "	Total # of Clusters: " << ((sectors_per_track / sectors_per_cluster)) * tracks << endl;
	cout << endl;
	if (ceil(tracks) == floor(tracks)){
		cout << "5." << endl;
		cout << "	Total Time for Reading Entire File (Continuous): " << total_time_per_track * tracks << " ms" << endl;
		cout << endl;
	}
	else{
		cout << "5." << endl;
		cout << "	Total Time for Reading Entire File (Continuous): " << ((total_time_per_track * floor(tracks)) + ((avgRD + seek_time) + ((tracks - (floor(tracks))) * (transfer_time)))) << " ms" << endl;
		cout << endl;
	}
	cout << "6." << endl;
	cout << "	Total Time for Reading 1 Cluster: " << Total_time_Reading_Cluster << " ms" << endl;
	cout << endl;
	cout << "7." << endl;
	double ans7 = ((seek_time + avgRD + (Total_time_Reading_Cluster)) * (records));
	cout << "	Total time for Reading Entire File (Random): " << ans7 << " ms or " << ans7 / 1000 << " s or " << ans7 / 60000 << " min " << endl;
	cout << "	Time per Record: " << (seek_time + avgRD + (Total_time_Reading_Cluster)) << endl;
}

int main() {
	double records = 100000.0;
	double bytes_per_record = 128.0;
	double seek_time = 7.0;
	double speed = 7200.0;
	double bytes_per_sector = 512.0;
	double sectors_per_cluster = 8.0;
	double sectors_per_track = 250.0;

	rotational_delay(speed, seek_time, bytes_per_record, bytes_per_sector);
	total_time(records, bytes_per_record, bytes_per_sector, sectors_per_track, sectors_per_cluster, speed, seek_time);

	cin.get();
	return 0;
}
