/*file name: mazer_finalproject
Abstract: This program plays a hangman game with the user. Words are read from a file ('Puzzles.txt'), 
guesses are input from the user. 
Name: Ariana Mazer
Date: 5.13.11
*/
#include <iostream>
#include <fstream>
#include <string>
#include <iomanip>
#include <cctype>
using namespace std;
	
class Puzzle
{
private:

	int wins;
	int losses;
	int number_letters;
	int num_games;	
	int wrong_guesses;
	int turns;
	char guess;
	char choice;
	bool found_guess;
	bool has_asterisk;
	string current_guesses;
	string guessed_letters;
	string word;

public:
	void print_puzzle();
	//This function prints the actual hangman based on the number of wrong guesses, and prints how many
	//wrong guesses and how many chances left.

	void do_asterisks();
	/*precondition: there is a file, that is being read in correctly, that holds words as strings for the puzzle.
	postcondition: each letter in the string (the word) has been output as an asterisk (hidden)*/

	void play_game();
	/*precondition: there are two other functions, do_asterisks and check_wins_and_losses that are performing correctly. 
	postcondition: The function has called the file, read in the word, called do_asterisks. It then goes through the steps
	of each turn; takes the users guess as input, checks the string word if the letter is 'correct', replaces the asterisk
	with the guess if it is correct. It records if it is wrong or right, and records the letters guessed and the number of 
	wrong guesses. It then calls check_wins_and_losses. 
	End result (postpost condidion): it plays a game of hangman to be called by the main function*/

	void check_wins_and_losses();
	/* precondition: do_asterisks and play_main are working correctly
	postcondition: It has checked if there are any asterisks left in the string word, and based on this information 
	tells the user whether they have won or lost the game.*/

	Puzzle();
	//constructor to initialize wins and losses. Does not initialize 'turns' because 'turns' needs to be reset every game.
};

int main()
{
	Puzzle hangman;
	hangman.play_game();
	return 0;
}

//uses iostream, class, string
void Puzzle::do_asterisks()
{
	current_guesses.resize(0);
	for (int j = 0; j < word.length(); j++)
	{
		current_guesses.push_back('*');
	}
	wrong_guesses = 0;
	guessed_letters.resize(0);
	//Note: unveiling of the letters is behind/off by one.
}

//uses iostream, iomanip, fstream, string, cctype
void Puzzle::play_game()
{
	ifstream in_file;
	in_file.open("C://Temp//puzzles.txt");
	if (in_file.fail())
	{
		cout << "I'm sorry, I cannot open that file.\n";
		exit(1);
	}
	do
	{
		in_file >> word;
		do_asterisks();
		turns = 1;//see constructor 'Puzzle' comment.
		do
		{

			found_guess = false;
			has_asterisk = false;
			cout << current_guesses;
			cout << endl;

			cout << "Turn " << turns << " - Please enter a guess: ";
			cin >> guess;
			guess = tolower(guess);

			turns++;
			
			guessed_letters.push_back(guess);
			for (int i = 0; i < word.length(); i++)
			{
				word[i] = tolower(word[i]);
				if (guess == word[i])
				{
					current_guesses[i] = guess;
					found_guess = true;
				}
			}
			if (found_guess)
			{
				cout << "Found at least one " << guess << endl;
			} 
			else
			{
				cout << "Didn't find any " << guess << "'s\n";
				wrong_guesses++;
			}
			cout <<"Guessed Letters: " << guessed_letters << endl;
			for (int k = 0; k < current_guesses.length(); k++)
				{
					if ( '*' == current_guesses[k])
					{
						has_asterisk = true;
					}
				}
		print_puzzle();
		}while(has_asterisk && wrong_guesses < 7);
	check_wins_and_losses();
	num_games++;
	cout << "Would you like to play again? (Y/N)\n";
	cin >> choice;
	}while(choice =='Y'||choice == 'y' && num_games < 10);
}

//uses iostream
void Puzzle::check_wins_and_losses()
{
	if (has_asterisk)
	{
		cout << "I'm sorry, you've lost the game. The solution was: ";
		cout << word << endl;
		losses++;
	}
	else
	{
		cout << "Congratulations! You've won the game! The solution was: ";
		cout << word << endl;
		wins++;
	}
	cout << "Wins: " << wins << endl;
	cout << "Losses: " << losses << endl;
}

//uses iostream, cctype, iomanip
void Puzzle::print_puzzle()
{
	if (wrong_guesses == 0)
	{
		cout << setw(19) <<"|---------|" << endl;
		cout << setw(19) << "|" << endl;
		cout << setw(19) << "|" << endl;
		cout << setw(19) << "|" << endl;
		cout << setw(19) << "|" << endl;
		cout << setw(24) << "----------|-----" << endl;
		cout << "Incorrect Guesses: " << wrong_guesses << endl;
		cout << endl;
	}
	else if (wrong_guesses==1)
	{
		cout << "	" <<setw(8) <<"|---------|" << endl;
		cout <<	setw(10) << "( )" <<setw(9)<<"|" << endl;
		cout << setw(19) << "|" << endl;
		cout <<	setw(19) << "|" << endl;
		cout <<	setw(19) << "|" << endl;
		cout <<	setw(24) << "----------|-----" << endl;
		cout << "Incorrect Guesses: " << wrong_guesses << endl;
		cout << endl;
	}
	else if (wrong_guesses ==2)
	{
		cout << "	" <<setw(8) <<"|---------|" << endl;
		cout <<	setw(10) << "( )" <<setw(9)<< "|" << endl;
		cout <<	setw(9) << "|" << setw(10) << "|" << endl;
		cout << setw(19) << "|" << endl;
		cout << setw(19) << "|" << endl;
		cout << setw(24) << "----------|-----" << endl;
		cout << "Incorrect Guesses: " << wrong_guesses << endl;
		cout << endl;
	}
	else if (wrong_guesses ==3)
	{
		cout << "	" <<setw(8) <<"|---------|" << endl;
		cout <<	setw(10) << "( )" <<setw(9)<< "|" << endl;
		cout << setw(9)<< "/|" << setw(10) << "|" << endl;
		cout << setw(19) << "|" << endl;
		cout << setw(19) << "|" << endl;
		cout << setw(24) << "----------|-----" << endl;
		cout << "Incorrect Guesses: " << wrong_guesses << endl;
		cout << endl;
	}
	else if (wrong_guesses ==4)
	{
		cout << "	" <<setw(8) <<"|---------|" << endl;
		cout <<	setw(10) << "( )" <<setw(9)<< "|" << endl;
		cout << setw(10)<< "/|\\" << setw(9) << "|" << endl;
		cout << setw(19) << "|" << endl;
		cout << setw(19) << "|" << endl;
		cout << setw(24) << "----------|-----" << endl;
		cout << "Incorrect Guesses: " << wrong_guesses << endl;
		cout << endl;
	}
	else if (wrong_guesses ==5)
	{
		cout << "	" <<setw(8) <<"|---------|" << endl;
		cout <<	setw(10) << "( )" <<setw(9)<< "|" << endl;
		cout << setw(10)<< "/|\\" << setw(9) << "|" << endl;
		cout << setw(8) << "/" << setw(11) <<"|" << endl;
		cout << setw(19) << "|" << endl;
		cout << setw(24) << "----------|-----" << endl;
		cout << "Incorrect Guesses: " << wrong_guesses << endl;
		cout << endl;
	}
	else if (wrong_guesses ==6)
	{
		cout << "	" <<setw(8) <<"|---------|" << endl;
		cout <<	setw(10) << "( )" <<setw(9)<< "|" << endl;
		cout << setw(10)<< "/|\\" << setw(9) << "|" << endl;
		cout << setw(10) << "/ \\" << setw(9) << "|" << endl;
		cout << setw(19) << "|" << endl;
		cout << setw(24) << "----------|-----" << endl;
		cout << "Incorrect Guesses: " << wrong_guesses << endl;
		cout << endl;
	}
	else if (wrong_guesses == 7)
	{
		cout << "	" <<setw(8) <<"|---------|" << endl;
		cout <<	setw(10) << "(X)" <<setw(9)<< "|" << endl;
		cout << setw(10)<< "/|\\" << setw(9) << "|" << endl;
		cout << setw(10) << "/ \\" << setw(9) << "|" << endl;
		cout << setw(19) << "|" << endl;
		cout << setw(24) << "----------|-----" << endl;
		cout << "Incorrect Guesses: " << wrong_guesses << endl;
		cout << endl;
	}
}

Puzzle::Puzzle()
{

	wins = 0; 
	losses = 0;
}