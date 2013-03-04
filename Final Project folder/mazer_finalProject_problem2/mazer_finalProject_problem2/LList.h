#include <iostream>
#include <string>
using namespace std;


#ifndef LLIST
#define LLIST

typedef string ElementType;

class LList
{
private:
    class Node
    {
    public:
        ElementType data;
		int count;
        Node * next;
        Node(){next = NULL;}
		Node(ElementType dataValue) 
        {data = dataValue; next = NULL;}
    };

    Node *first;
    int mySize;

public:
    LList(); // constructor
    ~LList(); // destructor
    LList(const LList & original); // copy constructor
    void insert(ElementType item);
    void erase(ElementType item);
    void traverse();
	void display(ostream & out) const;
	int findItem (ElementType item);
	ElementType maxItem();
	bool isAscendingOrder();
	void orderInsert(ElementType item); 
	void backwards_iterative();
	bool empty();
	bool search(ElementType item) const;
};

#endif
