#include <iostream>
#include <cstdlib>
#include "Runway.h"
using namespace std;

Runway::Runway()
{
	status = FREE;
	busy_duration = 0;
}

bool Runway::isFree()
{
	return status==FREE;
}

void Runway::setBusy(int time)
{
	status = BUSY;
	busy_duration = time;
}

void Runway::updateRunway()
{
	if (busy_duration > 0)
	{
		busy_duration--;
		if (busy_duration == 0)
			status=FREE;
	}
}