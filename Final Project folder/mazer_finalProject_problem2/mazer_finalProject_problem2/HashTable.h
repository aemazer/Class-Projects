#include <iostream>
#include <string>
using namespace std;
#include "LList.h"

#ifndef HASHTABLE
#define HASHTABLE

typedef string HashElement;
const int MAX = 26;
class HashTable
{
private:
	LList htable[MAX];
    int hashFun(const HashElement & value);
public:
    HashTable();
	void printTable() const;
    void insert(const HashElement & value);
    void remove(const HashElement & value);
    bool search(const HashElement & value);  
};
#endif