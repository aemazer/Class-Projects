#include <iostream>
#include <string>
using namespace std;
#include "HashTable.h"
#include "LList.h"

int HashTable::hashFun(const HashElement & value)
{
	int i = toupper(value[0]);
	i=i-13;
	return(i % MAX);
}
HashTable::HashTable()
{
}
void HashTable::insert(const HashElement & value)
{
	int index = hashFun(value);
	htable[index].orderInsert(value);
}

void HashTable::printTable() const
{
	for(int i=0; i < MAX; i++)
	{
		cout << " Index " << i << " " << "Element ";
		htable[i].display(cout);
		cout << endl;
	}
}

void HashTable::remove(const HashElement & value)
{
	if (!search(value))
	{
		cout << "Oops! value to remove isn't there" << endl;
	}
	else
	{
		int index = hashFun(value);
		htable[index].erase(value);
	}
}

bool HashTable::search(const HashElement & value)
{
	int index = hashFun(value);
	if(htable[index].search(value))
		return true;
	else 
		return false;
}