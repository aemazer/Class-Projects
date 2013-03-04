#include "LList.h"


LList::LList()
{
    mySize = 0;
    first = NULL;
}

LList::~LList()
{
    Node * prev = first;
    Node * ptr;
       
    while (prev != NULL)
    {
        ptr = prev->next;
        delete prev;
        prev = ptr;
    }
       
}

LList::LList(const LList & original)
{
	cout << "\nCopy Constructor Called\n";
	mySize = original.mySize;
	first = NULL;
	
	if (mySize == 0) 
		return;

	Node * origPtr, * lastPtr;
	first = new Node(original.first->data); // copy first node
	lastPtr = first;
	origPtr = original.first->next;
	while (origPtr != NULL)
	{
		lastPtr->next = new Node(origPtr->data);
		origPtr = origPtr->next;
		lastPtr = lastPtr->next;
	}
}

void LList::insert(ElementType item)
{
	Node *newPtr = new (nothrow) Node(item);
	if(newPtr == NULL)
	{
		cerr << "can't allocate." << endl;
		return;
	}
	newPtr->next=first;
	first = newPtr;
}

void LList::erase(ElementType item)
{
  
    Node * ptr=NULL;
    Node * predPtr = first;
	bool found = false;

	while(predPtr !=NULL)
	{
		if(predPtr->data == item)
		{
			found = true;
			break;
		}
		ptr=predPtr;
		predPtr = predPtr->next;
	}
	if(found)
	{
		if (predPtr == first)
		{
			first = predPtr->next;
		}
		else
		{
			ptr->next=predPtr->next;
		}
		delete predPtr;
	}
	else
	{
		cerr << "item to delete not in list." << endl;
	}
}

// This function shows the general algorithm for traversing a linked list
// See the implementation of display below to see how you might use this
// to do something useful like print out the elements in a list
void LList::traverse()
{
	Node * ptr = first;
	while(ptr != 0)
	{
		ptr = ptr->next;
	}
}

//-- Definition of display()
void LList::display(ostream & out) const
{
	Node * ptr = first;
	while (ptr != 0)
	{
		out << ptr->data << " " << "Times Appeared: " << ptr->count << " ";
		ptr = ptr->next;
	}
}

int LList::findItem(ElementType item)
{
	if (first == NULL)
	{
		cerr << "List is empty" << endl;
		return -1;
	}
	Node * ptr = first;
	int index = 0;
	while (ptr !=0)
	{
		if (ptr->data == item)
		{
			return index;
		}
		ptr=ptr->next;
		index++;
	}
	return -1;
}

ElementType LList::maxItem()
{
	string max=0;
	Node * ptr=first;
	Node * prev = NULL;

	if(first==NULL)
	{
		cerr << "***Empty List, no max value. ***" << endl;
	}

	else
	{
		max=first->data;
		while (ptr!=0)
		{
			if (ptr->data > max)
			{
				max = ptr->data;
			}
			prev=ptr;
			ptr=ptr->next;
		}
		return max;
	}
	return NULL;
}

//NEEDS WORK!!!! RETURNS ONLY TRUE
bool LList::isAscendingOrder()
{
	if(first==NULL)
	{
		return true;
	}
	int temp = 1;
	Node * ptr = first;
	Node * prev = NULL;

	while(ptr !=0)
	{
		if (ptr > prev)
		{
			temp++;
		}
		prev = ptr;
		ptr=ptr->next;
	}
	mySize++;
	if(temp < mySize)
	{
		return false;
	}
	else
	{
		return true;
	}

}
void LList::orderInsert(ElementType item)
{
    Node * newPtr = new Node(item);
	Node * ptr = first;
	Node * prev=NULL; 
	newPtr->count = 1;
	//the below if statement is what Brian helped me with.
	if(search(item))
	{
		while(ptr->data != item)
		{
			ptr = ptr->next;
		}
		ptr->count++;
		return; // don't insert a copy
	}

	if (first == NULL)
	{
		newPtr->next = first;
        first = newPtr;
	}
	else if (newPtr->data < first->data)
	{
		newPtr->next = first;
        first = newPtr;
	}
	else 
	{
		while (ptr !=0)
		{
			if (ptr->data > item)
			{
				newPtr->next = ptr;
				prev->next = newPtr;
				break;
			}
			
			if(ptr->next==NULL)
			{
				ptr->next=newPtr;
				newPtr->next=NULL;
			}
			prev=ptr;
			ptr=ptr->next;
		}
	}
	mySize++;
}
// The below is commented out because of compiler issues dealing with the string element.
//void LList::backwards_iterative()
//{
//	if(first == NULL)
//	{
//		cerr << "List is empty\n";
//		return;
//	}
//    Node * ptr = first;
//    int * myArray = NULL;
//    int n = 0;
//   
//    myArray = new int[n];
//    while (ptr != NULL)
//    {
//         n++;
//        for (int i= n; i < n+1; i++)
//        {
//            myArray[i] = ptr-> data;//conversion of string (element) to int
//        }
//        ptr = ptr -> next;
//    }
//    for (int k = n; k>0 ; k--) 
//    {
//        cout  << myArray[k] << " ";
//    }
//}

bool LList::empty()
{
	if(first == NULL)
		return true;
	else
		return false;
}

bool LList::search(ElementType item) const
{
	Node * current =first;

	while(current !=NULL)
	{
		if(current->data == item)
		{
			return true;
		}

		current = current->next;
	}
	return false;
}
