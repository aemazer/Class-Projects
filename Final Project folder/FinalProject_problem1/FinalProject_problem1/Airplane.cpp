#include <iostream>
#include "Airplane.h"

Airplane::Airplane()
{
	startTime = 0;
}

Airplane::Airplane(int time)
{
	startTime = time;
}

int Airplane::getStartTime()
{
	return startTime;
}

ostream & operator<<(ostream & out, Airplane & air)//got brian's help with this function
{
	out << "I've been waiting since " << air.getStartTime() << endl;
	return out;
}