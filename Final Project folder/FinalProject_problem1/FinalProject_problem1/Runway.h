#include <iostream>
using namespace std;
#ifndef RUNWAY
#define RUNWAY
enum Status{FREE, BUSY};
class Runway
{
	Status status;
	int busy_duration;

public:
	Runway();
	bool isFree();
	void setBusy(int time);
	void updateRunway();
};
#endif