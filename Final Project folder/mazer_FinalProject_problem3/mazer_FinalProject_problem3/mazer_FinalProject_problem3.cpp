/*
File Name: mazer_FinalProject_problem3
Abstract: To implement the following functions for a BST:
		isValidBST(): Checks if the Binary Search Tree follows the rules of a true BST
		totalNodes(): counts the total nodes in the BST
		isBalanced(): Checks to see if the BST is balanced or not
Name: Ariana Mazer
Date: 12.8.11

For isBalanced, I got some help from wikipedia for the algorithm.
*/


#include <iostream>
using namespace std;
#inlcude "BST.h"


//helper function for isValidBST.Private member function
bool BST::checkValidity(BTreeNode * subtree)
{
	if(subtree == NULL)
	{
		return true;
	}
	else if(subtree->left==NULL && subtree->right==NULL)
	{
		return true;
	}
	if(subtree->right->data > subtree->data)
	{
		return (checkValidity(subtree->right));
	}
	if(subtree->left->data < subtree->data)
	{
		return (checkValidity(subtree->left));
	}
	if(subtree->right->data < subtree->data||subtree->left->data >subtree->data)
		return false;
	return(subtree->left&&subtree->right);
}
//public member function
bool BST::isValidBST()
{
	return (checkValidity(BSTRoot));
}
//this function is what I tested a false BST with. It is simply the original insert with the inequality signs switched.
void BST::insertBackwards(const ElementType & item)
{
	BTreeNode * pPtr = NULL;
	BTreeNode * currPtr = BSTRoot;
	BTreeNode * newPtr = new (nothrow) BTreeNode(item);
	if(BSTRoot==NULL)
	{
		BSTRoot=newPtr;
	}
	else
	{
		while(currPtr!=NULL)
		{
			pPtr=currPtr;
			if(item > currPtr->data)
			{
				currPtr=currPtr->left;
			}
			else if(item < currPtr->data)
			{
				currPtr=currPtr->right;
			}
		
		}
		if (item > pPtr->data)
		{
			pPtr->left = newPtr;
		}
		else
		{
			pPtr->right=newPtr;
		}
	}
}

//totaNodes uses this private function
int BST::totalInternal(BTreeNode * subtree, int &total)const
{
	if(subtree == NULL)
	{
		return 0;
	}
	else
	{
		totalInternal(subtree->left, total);
		total++;
		cout << "Total = " << total << endl;//checking to make sure the total is what I want it to be
		totalInternal(subtree->right, total);
		
	}
	return total;
}
//realized that totalNodes was almost exactly like inorder, so I copied that code and made it work for me
//inlcuding its helper function.
int BST::totalNodes()
{
	int total = 0;
	totalInternal(BSTRoot, total);
	cout << "total in totalNodes = " << total << endl;//checking that the total nodes is the same as in totalInternal
	return total;
}
//private member function to help isBalanced
int BST::max_depth(BTreeNode * subtree) const
{
	if(subtree==NULL)
	{
		return 0;
	}
	else
	{
		return 1+max(max_depth(subtree->left), max_depth(subtree->right));
	}
}
//private member function to help isBalanced
int BST::min_depth(BTreeNode * subtree) const
{
	if(subtree == NULL)
	{
		return 0;
	}
	else
	{
		return 1+min(min_depth(subtree->left), min_depth(subtree->right));
	}
}
//private member function to help isBalanced
bool BST::balanceHelper(BTreeNode*subtree)
{
	if(max_depth(subtree) - min_depth(subtree) <=1)
	{
		return true;
	}
	else
		return false;
}
bool BST::isBalanced()
{
	return balanceHelper(BSTRoot);
}
