/*
Project name: FinalProject_problem1
Abstract: To simulate Monterey Airport, using a one server, multiple job queue system
Name: Ariana Mazer
Date: 12.9.11

Help gotten from Brian Olson, Kate Lockwood, and simulation example provided by Kate. 
Also worked a little bit on the project with Jared Miller, Leigh Ann Warner and my group from the brainstorming activity.
*/

#include <iostream>
#include <cstdlib>
#include <ctime>
#include "Airplane.h"
#include "Runway.h"
#include "LLQueue.h"

using namespace std;
//the below consts can be changed to any number, but between 1 and 10 gets you the best results.
const int TAKEoffAVG = 5;
const int LandAVG = 5;

void planepic();
void doSimulation(int time, int report, int landingTime, int takeOffTime);
void Report(LLQueue & landing, LLQueue & takeOff, int currTime, int numLanded, int numTakeOff);
void end();//for fun
int main()
{
	srand(time(NULL));
	int length_sim = 0;
	int report_int = 0;
	int landingTime = 0;
	int takeOffTime = 0;
	char ans;
	do
	{
		cout << "Please enter the ammount of time you wish to run the simulator: ";
		cin >> length_sim;
		cout << endl;
		cout << "Please enter the report interval you would like to recieve: ";
		cin >> report_int;
		//I decided to have the time it takes land and take off as user input, it varies for every airport, as well as the type of plane, 
		//so you can enter different times to get results. I recommend 5-7 minutes for the best simualation results.
		cout << "How many minutes does it take a plane to land?: ";//I recommend entering between 5 and 10, but you get interesting results with others
		cin >> landingTime;
		cout << "How many minutes does it take a plane to take off?: ";//I recommend entering between 5 and 10,
		cin >> takeOffTime;
		doSimulation(length_sim, report_int, landingTime, takeOffTime);
		cout << "Would you like to run another simulation? (y/n): ";
		cin >> ans;
	}while(ans == 'Y'||ans=='y');
	//after simulation runs
	cout << "Thank you for flying CST 238 Airlines!" << endl;
	cout << "        |" << endl;
	cout << "*---O--(_)--O---*" <<endl;
	end();
	return 0;
}
/*
I deceded to have most of my functionality, including the clock, in the driver function for ease of accessability. 
I originally had a clock class, but unless I wanted to do all of the below actions in the clock class, it was fairly 
usless, as all it was was an integer being incramented, and I really had no way of integrating the rest of my work into there.
So, doSimulation is what takes care of the majority of the work.
*/
void doSimulation(int time, int report, int landingTime, int takeOffTime)
{
	Runway runway;
	LLQueue takeOffQ;
	LLQueue landingQ;
	int total_takeOff_wait = 0;
	int total_landing_wait = 0;
	int numPlanes_landing = 0;
	int numPlanes_takeOff = 0;
	int total_takeOff_length = 0;
	int total_landing_length = 0;


	for(int currentTime = 0; currentTime < time; currentTime++)
	{
		//see if we should enqueue some planes
		double temp1 = ((double)rand()/RAND_MAX);
		double temp2 = ((double)rand()/RAND_MAX);
		if(temp1 < TAKEoffAVG/60.0)
		{
			//cout << "Enqing takoff at: "<<currentTime << endl;
			takeOffQ.enqueue(Airplane(currentTime));
		}
		if(temp2 < LandAVG/60.0)
		{
			//cout << "Enqing landing at: "<< currentTime << endl;
			landingQ.enqueue(Airplane(currentTime));
		}
		if(runway.isFree())
		{
			//if the wait of a grounded plane is over a certain limit, dequeue asap. I changed the time limit to 
			//120 because the plane that is over the wait limit still has to wait until the runway is free, so setting
			//the time lower accounts for that.
			if(!takeOffQ.empty() && currentTime - takeOffQ.front().getStartTime() > 120)
			{
				Airplane late = takeOffQ.front();
				takeOffQ.dequeue();
				//cout << "TakeOff dequeued, time > 120" << endl;
				total_takeOff_wait += (currentTime-late.getStartTime()); //some calculations to be used for averaging
				numPlanes_takeOff++;//some calculations to be used for averaging
				runway.setBusy(takeOffTime);
			}
			else if (!landingQ.empty())//if there are no planes at the time limit, the landing planes have priority
			{
				Airplane hello = landingQ.front();
				landingQ.dequeue();
				//cout << "Landing dequeued"<<endl;
				total_landing_wait +=(currentTime-hello.getStartTime());//to be used for averaging
				numPlanes_landing++;//to be used for averaging
				runway.setBusy(landingTime);
			} 
			else if (!takeOffQ.empty())//and lastly, dequeue any planes in the take off queue.
			{
				Airplane goodbye = takeOffQ.front();
				takeOffQ.dequeue();
				//cout << "TakeOff dequeued" << endl;
				total_takeOff_wait+=(currentTime-goodbye.getStartTime()); //to be used for averaging
				numPlanes_takeOff++;//to be used for averaging
				runway.setBusy(takeOffTime);
			}
		} // end of runway.isFree check
		total_takeOff_length+=takeOffQ.length();//to be used for average and report
		total_landing_length+=landingQ.length();//used for average and report
		runway.updateRunway();

		if (currentTime%report == 0)
		{
			Report(landingQ, takeOffQ, currentTime, numPlanes_landing, numPlanes_takeOff);
			cout <<endl;
		}
	}

	double landingAvgWait = ((double)total_landing_wait/numPlanes_landing);
	double takeOffAvgWait = ((double)total_takeOff_wait/numPlanes_takeOff);
	double avgLandingLength = (total_landing_length/numPlanes_landing);
	double avgTakeOffLength = (total_takeOff_length/numPlanes_takeOff);
	if(numPlanes_landing !=0)//if the denominator is zero, the calculation fails and causes and abort in runtime.
	{
		cout << " The average wait time of the Landing queue is: " << landingAvgWait << endl;
		cout << "The average length of the landing queue is: " << avgLandingLength<<endl;
	}
	else
		cout << "No planes have landed within the simulation time. No average could be calculated." << endl;
	if(numPlanes_landing !=0)//if the denominator is zero, the calculation fails and causes and abort in runtime.
	{
		cout << "The average wait time of the Take Off queue is: " << takeOffAvgWait << endl;
		cout << "The average length of the Take Off queue is: " << avgTakeOffLength<<endl;
	}
	else
		cout <<"No Planes have taken off within the simulation time. No average could be calculated." << endl;

}

void Report(LLQueue & landing, LLQueue & takeOff, int currTime, int numLanded, int numTakeOff)
{
	cout << "The number of planes in the Landing Queue: " << landing.length() << endl;
	cout << numLanded << " planes have landed." << endl;
	if (!landing.empty())
		cout << "The first plane in line has been waiting  " << (currTime - landing.front().getStartTime())<< " minutes" << endl;
	cout << "The number of planes in the Take Off Queue: " << takeOff.length() << endl;
	cout << numTakeOff << " planes have taken off." << endl;
	if (!takeOff.empty())
		cout << "The first plane in line has been waiting for " <<(currTime- takeOff.front().getStartTime())<<" minutes" << endl;
}
//did this function for fun. Enjoy :)
void end()
{
	cout <<"                 |" <<endl;
	cout <<"                 |" <<endl;
	cout <<"                o|o " <<endl;
	cout << "         -----/     \\-----" << endl;
	cout <<"\\____________(( +++ ))_______________/" << endl;
	cout <<"    O    O   ~~~~~~~~~   O      O" << endl;
}