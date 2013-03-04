#include <iostream>

using namespace std;

#ifndef AIRPLANE
#define AIRPLANE

class Airplane
{
private:
	int startTime;
public:
	Airplane();
	Airplane(int time);
	void clock();
	int getStartTime();
};

ostream & operator<<(ostream & out, Airplane & air);//brian's help

#endif