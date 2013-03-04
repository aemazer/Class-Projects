#include "LLQueue.h"

LLQueue::LLQueue()
{
    qFront = qRear = 0;
}

bool LLQueue::empty() const
{
    return (qFront == 0);
}

void LLQueue::enqueue(const QueueElementType & value)
{
	Node * newNode = new Node(value, NULL);
	if(newNode == 0)
	{
		cerr << "Insufficient Memory for new Node\n";
		exit(1);
	}
	if(empty())
	{
		qFront = newNode;
		qRear = newNode;
	}
	else
	{
		qRear->next = newNode;
		qRear = newNode;
	}
}

void LLQueue::display(ostream & out) const
{
	Node * current = qFront;
	while(current != NULL)
	{
		out << current->data << " ";
		current = current->next;
	}
	out << endl;
}

QueueElementType LLQueue::front() const
{
    if(!empty())
    {
        return qFront -> data;
    }
    else
    {
        cerr << "Queue Empty!\n";
        exit(1);
    }
}

void LLQueue::dequeue()
{
    if(!empty())
    {
		Node * temp = qFront;
		qFront = qFront->next;
		delete temp;
		// If Queue is empty, make sure qRear is set back to NULL
		if(qFront == 0)
		{
			qRear = 0;
		}
    }
    else
    {
        cerr << "Can't remove from empty queue!\n";
    }
}

LLQueue::~LLQueue()
{
	Node * current = qFront;
	Node * temp;
	while (current != NULL)
	{
		temp = current->next;
		delete current;
		current = temp;
	}
}

const LLQueue & LLQueue::operator=(const LLQueue & rhs)
{
	if(this != &rhs)
	{
		this->~LLQueue();
		if(rhs.empty())
		{
			qFront = qRear = 0;
		}
		else
		{
			Node * newNode = new Node(rhs.front());
			qFront = qRear = newNode;

			Node * currentNode = rhs.qFront->next;
			while(currentNode != 0)
			{
				qRear->next = new Node(currentNode->data);
				qRear = qRear->next;
				currentNode = currentNode->next;
			}
		}
	}

	return *this;
}

LLQueue::LLQueue(const LLQueue & original)
{
	qFront = qRear = 0;
	if(!original.empty())
	{
		Node * newNode = new Node(original.front());
		qFront = qRear = newNode;

		Node * currentNode = original.qFront->next;
		while(currentNode != 0)
		{
			qRear->next = new Node(currentNode->data);
			qRear = qRear->next;
			currentNode = currentNode->next;
		}
	}
}

int LLQueue::length()
{
	int count=0;
	Node * current = qFront;
	while (current != NULL)
	{
		count++;
		current = current->next;
	}
	return count;
}
