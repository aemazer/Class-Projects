/*Project Name: Mazer_Project_2, RentalCarSim.java
 * Abstract: This is the main working component in a rental car reservation system.
 * 			this program is based off of the use-case provided by Dr. Byun, and allows
 * 			the user to create an account, reserve one of three types of cars (Sedan, Minivan,
 * 			Truck), cancel a reservation, and view all transactions as a manager.
 * ID: 0338
 * Name: Ariana Mazer
 * Date: 5.9.2012
 */
import java.util.ArrayList;
import java.util.InputMismatchException;
import java.util.Scanner;

public class RentalCarSim
{
	public static void main(String[] args)
	{
		Scanner sc = new Scanner (System.in); 
         RentACar car = new RentACar();
        int option; 
        System.out.println("Welcome to CSUMB Rental Car System"); 
                   
        do 
        { 
            System.out.println("Select your choice:"); 
            System.out.println("    1. Open an account"); 
            System.out.println("    2. Make A reservation"); 
            System.out.println("    3. Cancel A reservation"); 
            System.out.println("    4. Exit"); 
            option = sc.nextInt(); 
                           
            if (option == 1)         
            { 
            	car.createAccount(); 
            } 
            else if (option == 2)
            {
            	car.MakeReservation();
            }
            else if (option == 3)
            { 
                car.CancelReservation(); 
            } 
            else if(option == 4)
            {
            	System.out.println("Bye!");
            	return;
            }
            else 
            { 
                System.out.println("Incorrect option"); 
            } 
            System.out.println("\n"); 
        } while (true); 
    } 
}
//main class that controls the entire simulation.
class RentACar
{
	private Transaction trans;
	public static ArrayList<Account> accounts;//arrayList to keep track of all accounts created
	public static ArrayList<Transaction> transactions;//array List to keep track of all transactions
	public static ArrayList<String> dates;//used to keep track of reservation dates
	public static int numAccounts=0;
	public static int numTransactions = 0;
	public static ArrayList<Reservation> reservations;
	public static int numReservations=0;

	RentACar()//initializes array lists
	{
		accounts = new ArrayList<Account>(numAccounts);
		transactions = new ArrayList<Transaction>(numTransactions);
		dates = new ArrayList<String>();
		reservations = new ArrayList<Reservation>(numReservations);
		
	}
	public void createAccount()
	{
		String name=null;
		String password=null;
		Scanner sc = new Scanner (System.in);
		Account myAcct=new Account();
		Transaction trans;
		int rand = 0;//counter
		do
		{
			System.out.print("Please enter a username: ");
			name = sc.next();
			System.out.print("Please enter a password: ");
			password = sc.next();
			
			if(!findUsername(name))//if the username isn't found in the array of Account usernames
			{	
				if((myAcct.checkPassword(password)&&myAcct.checkUsername(name)))//if the password and username are valid according to specifications
				{
					myAcct.setName(name);
					myAcct.setPassword(password);
					numAccounts++;
					accounts.add(myAcct);
					trans = new Transaction(myAcct);
					numTransactions++;
					transactions.add(trans);
					System.out.print("Account Created Successfully at ");
					trans.print();		
					
				}
				else
					System.out.println("Invalid information entered. Please try again");
			}
			else
				System.out.println("this account already Exists. Please try again");
			rand++;	
		}while(!(myAcct.checkPassword(password)&&myAcct.checkUsername(name))&&(rand <2));//if the account creation fails twice, return to main menu.
	}
	
	public void MakeReservation()
	{
		String name=null;
		String password=null;
		int choice = 0;
		int pickUpDay = 0;
		int returnDay = 0;
		Reservation myRes;
		int count = 0;
		String date="";
		Account found = new Account();
	
		Scanner sc = new Scanner (System.in);
		//user must enter 1, 2 or 3. This try/catch is to make sure that is correct.
		try
		{
			System.out.print("Please input the number option of your choice of the following options of vehicles:\n" +
							"	Sedan: 	 (1) \n	Minivan: (2) \n	Truck: 	 (3)\n");
			choice = sc.nextInt();
		}
		catch(InputMismatchException e)
		{
			System.out.print("Invalid option. Please enter a valid vehicle selection");
		}
	
		do//validate pickup day. errors result in unlimited try again
		{
			System.out.print("Please select a pick up day: June ");
			pickUpDay = sc.nextInt();
			System.out.print("Please select a return day: June ");
			returnDay = sc.nextInt();
			if(!isValidDate(pickUpDay, returnDay))//make sure the dates are between the 1st and 31st, and the second date is after the first.
				System.out.println("Invalid Dates. Please try again");
			count++;
			if(!isValidDate(pickUpDay, returnDay)&&count==2)
			{
				System.out.println("Reservation attempt failed");
				return;
			}
		}while(!isValidDate(pickUpDay, returnDay)&&count<2);
		
			if(isValidDate(pickUpDay, returnDay))
			{
				for(int i=pickUpDay; i <= returnDay; i++)//creating string of the dates to check if the vehicle is reserved for this time period
				{
					date+=i;
				}
				
			}
			//validate account. 2 errors result in return to main menu.
		if(checkReservedV(date, choice))
		{ 		
			System.out.print("Please enter a username: ");
			name = sc.next();
			System.out.print("Please enter a password: ");
			password = sc.next();
			
			while(!findUsername(name)&& count<2)//check if login is valid. 2 tries are allowed.
			{	
				System.out.println("Invalid account information. Try again");
				count++;
				System.out.print("Please enter a username: ");
				name = sc.next();
				System.out.print("Please enter a password: ");
				password = sc.next();
				if(count ==2)
				{
					System.out.println("Login Failed");
					return;
				}
			}
					
			//also for the string date, for checking if a vehicle is reserved for this time period
			if(choice == 1)
				date+="S";
			if(choice ==2)
				date+="V";
			if(choice==3)
				date+="T";
			dates.add(date);
			found = findAccount(name);
			
			if(!found.equals(null))//check if user chooses to make a reservation first.
			{
				myRes = new Reservation(choice, pickUpDay, returnDay, found);
				////found.addReservation(myRes);
				numReservations++;
				reservations.add(myRes);
				trans = new Transaction(myRes);
				numTransactions++;
				transactions.add(trans);
	
				myRes.print();
			}
			else
				System.out.print("Invalid Account.");
		}
		else
			System.out.print("Invalid vehicle choice");
	}
	public void CancelReservation()
	{
		String name=null;
		String password=null;
		Scanner sc = new Scanner (System.in);
		int count = 1;
		int cancel = 0;
		int check = 0;
		Transaction trans;
		
		System.out.print("Please enter a username: ");
		name = sc.nextLine();
		System.out.print("Please enter a password: ");
		password = sc.nextLine();
		
		if(isAdmin(name, password))//check if the user is the administrator, with a username and password of admin2
		{
			ManageSystem();
		}
		else
		{
				while((!findUsername(name)&& count<2))//2 login attempts are allowed.
				{	
					System.out.println("Invalid account information. Try again");
					count++;
					System.out.print("Please enter a username: ");
					name = sc.next();
					System.out.print("Please enter a password: ");
					password = sc.next();
					if(count ==2)
					{
						System.out.println("Login Failed");
						return;
					}
				}
			Account found = findAccount(name);
			do
			{
				for(int i = 0; i < numReservations; i++)
				{
					if(reservations.get(i).getAccout().equals(found))
					{
						reservations.get(i).print();
						check++;
					}
				}
				if(check>0)
				{
					int temp=0;
					System.out.print("Please enter the reservation number of the Reservation you wish to cancel: ");
					cancel = sc.nextInt();
					for(int i = 0; i <check; i++)
					{
						if(reservations.get(i).getResNum()==cancel)
						{
							String s1 =  reservations.get(i).toString();
							trans = new Transaction("Cancelation", s1);
							numTransactions++;
							transactions.add(trans);
							System.out.print("Reservation " + reservations.get(i).getResNum() + " canceled.");

							int temp1=reservations.get(i).getPickupDay();
							int temp2=reservations.get(i).getReturnDay();
							String tempDate=null;
							int choice = reservations.get(i).getVTypeNum();
							
							for(int j=temp1; j <=temp2; j++)//need to delete the reserved days from the dates string, so they may be reserved/available again.
							{
								tempDate+=j;
							}
							if(choice == 1)
								tempDate+="S";
							if(choice ==2)
								tempDate+="V";
							if(choice==3)
								tempDate+="T";
						
							cancelReservedV(tempDate, choice);
							
							reservations.remove(i);
							numReservations--;
							temp++;
						}
						if(temp < 1)
							System.out.println("There are no reservations with that number. Please try again");
						
					}
				}
				else
					System.out.print("This account has no reservations.");
					count++;
			}while(found.equals(null)&&count<2);
		}
	}
	private boolean isValidDate(int d1, int d2)
	{
		return(d2>d1 &&d1<=30&&d2<30&&d1>0&&d2>0);
	}
	
	private void cancelReservedV(String date, int choice)
	{
		if(dates.size()>0)
		{
			for(int i = 0; i < dates.size(); i++)
			{
				if((choice ==1 && dates.get(i).contains("S"))||(choice ==2 && dates.get(i).contains("V"))||(choice ==3 && dates.get(i).contains("T")))
				{
					for(int j = 0; j< dates.get(i).length(); j++)
					{
						if(date.charAt(i)==dates.get(i).charAt(j))
						{
							dates.remove(i);						
						}
					}
						
				}
			}
		}
	}
	private boolean checkReservedV(String date, int choice)//WORKING CODE!!!!
	{
		if(dates.size()>0)
		{
			for(int i = 0; i < dates.size(); i++)
			{
				if((choice ==1 && dates.get(i).contains("S"))||(choice ==2 && dates.get(i).contains("V"))||(choice ==3 && dates.get(i).contains("T")))
				{			
					for(int k = 0; k < dates.get(i).length(); k++)
					{
						if(date.charAt(i)==dates.get(i).charAt(k))
						{
							System.out.println("There are no vehicles of this type available at the" +
									"selected time and date. Please choose another type of vehicle");
							return false;
						}
					}				
				}
			}
		}
		return true;
	}

	private boolean isAdmin(String name, String password)
	{
		return(name.equals("admin2")&&password.equals("admin2"));
	}
	private void ManageSystem()
	{
		Scanner sc = new Scanner (System.in);
		String op = null;
		do
		{
			for(int i = 0; i < numTransactions; i++)
			{
				transactions.get(i).print();
				System.out.print("\n\n");
			}
			System.out.print("Would you like to exit? (y/n)");
			op = sc.next();
		}while(op.equalsIgnoreCase("n"));
	}

	private boolean findUsername(String name)
    {
        for(int i=0; i < numAccounts; i++)
        {
            if(accounts.get(i).getUsername().equals(name)) 
            {
                return true;
            }
        }
        return false;
    }
	private Account findAccount(String temp)
	{
		for(int i = 0; i < numAccounts; i++)
		{
			if(accounts.get(i).getUsername().equals(temp))
				return accounts.get(i);
		}
		return null;
	}
}