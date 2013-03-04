/*
project name: mazer_finalProject_problem2
Abstract: To read a text file and print an alphabetized list of all of the words that appear
		in the file along with how many times that word occurred using a Hash Table and resolving
		collisions using linked lists.
Name: Ariana Mazer
Date: 12.8.11

I got help from Brian Olson regarding the count of the words, and worked a little bit with John Wesolowski on 
resolving the problem. Also worked with Leigh Anne Warner on the problem of checking for white spaces in between words, 
and resolved the problem with her help.
*/

#include <iostream>
#include <string>
#include <fstream>
using namespace std;
#include "HashTable.h"
#include "LList.h"
int main()
{
	HashTable htable;

	string s1;
	char val;

	ifstream infile;

	cout << "Please enter the name of the file you wish to open. (file_name.txt): ";
	cin >> s1;

	infile.open(s1);
	if (infile.fail())
	{
		cout << "Error. Could not open file.\n";
		exit(1);
	}

	while(!infile.eof())
	{
		do
		{
			getline(infile, s1);
			for (int i = 0; i < s1.length(); i++)
			{
				s1[i]=toupper(s1[i]);
			}//converting all letters to uppercase to do away with any case-sensitive problems.
			for(int j = 0; j < s1.length(); j++)//check for spaces, making a new string if there is.
			{
				if(isspace(s1[j]))
				{
					htable.insert(s1.substr(0, j));
					s1 = s1.substr(j+1, s1.length()-1);
					j=0;
				}
			}
				
			htable.insert(s1);
		}while (!'/n');
	}
	cout << "Testing" << endl;
	htable.printTable();
}