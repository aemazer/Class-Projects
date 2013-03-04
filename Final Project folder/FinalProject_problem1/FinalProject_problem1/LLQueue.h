#include <iostream>
#include "Airplane.h"
using namespace std;

#ifndef LLQUEUE
#define LLQUEUE

typedef Airplane QueueElementType;

class LLQueue
{
private:
	class Node
	{
	public:
		QueueElementType data;
		Node * next;
		Node(QueueElementType value, Node * link = 0)
		{
			data = value;
			next = link;
		}
	};

	Node * qFront;
	Node * qRear;
	int priority;

public:
    LLQueue();
	LLQueue(const LLQueue & original); // copy constructor
	~LLQueue(); // destructor
	const LLQueue &operator= (const LLQueue & rhs); // assignment
    bool empty() const;
	bool full() const;
    void enqueue(const QueueElementType & value);
    void display(ostream & out) const;
    QueueElementType front() const;
    void dequeue();
	int length();
	//void updateQue(LLQueue & LandingQ, LLQueue & takeOffQ);
};

#endif