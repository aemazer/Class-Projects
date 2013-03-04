/*Project Name: Project2_Mazer, RentalCarSim.java
 * Abstract: This is the main working component in a rental car reservation system.
 * 			this program is based off of the use-case provided by Dr. Byun, and allows
 * 			the user to create an account, reserve one of three types of cars (Sedan, Minivan,
 * 			Truck), cancel a reservation, and view all transactions as a manager. This is the GUI
 * 			version of my other Rental Car simulation.
 * NOTE:: This is a test project and is not complete. It was a first attempt at a larger scale GUI
 * 			java project. 
 * ID: 0338
 * Name: Ariana Mazer
 * Date: 5.9.2012
 */
import java.util.ArrayList;
import java.util.Scanner;
import java.awt.*;
import java.awt.event.*;

import javax.swing.*;
public class RentalCarSim
{
	public ArrayList<Account> accounts;
	public ArrayList<Transaction> transactions;
	public static int numAccounts=0;
	public static int numTransactions = 0;
	public static ArrayList<String> dates;//used to keep track of reservation dates
	public static ArrayList<Reservation> reservations;
	public static int numReservations=0;

	public static void main(String[] args)
	{
		RentalCarSim myRental = new RentalCarSim();		
	}
	
	public RentalCarSim()
	{
		accounts = new ArrayList<Account>(numAccounts);
		transactions = new ArrayList<Transaction>(numTransactions);
		dates = new ArrayList<String>();
		reservations = new ArrayList<Reservation>(numReservations);
		JFrame gui = new RentalFrame();
		gui.setVisible(true);
	}

	private class RentalFrame extends JFrame
	{
		public RentalFrame()
		{
			setTitle("CSUMB RentACar");
			setSize(300,300);
			setResizable(false);
			setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
	        JPanel panel = new MainPanel();
	        this.add(panel);
	        centerWindow(this);
		}
	    private void centerWindow(Window w)
	    {
	        Toolkit tk = Toolkit.getDefaultToolkit();
	        Dimension d = tk.getScreenSize();
	        setLocation((d.width-w.getWidth())/2, (d.height-w.getHeight())/2);
	    }
	}
	
	private class MainPanel extends JPanel implements ActionListener
	{
		private JRadioButton createAccount, makeRes,
							 cancelRes;
		private JPanel blank1, blank2, blank3, blank,
						createP, makeP, cancP;
		private JButton next, cancel;
		private JLabel welcome, extra;
		
		public MainPanel()
		{
			setLayout(new GridLayout(7, 1));
			
			ButtonGroup sizeGroup = new ButtonGroup();
			
			welcome = new JLabel("Welcome to CSUMB RentACar!");
			blank = new JPanel();
			blank.add(welcome);
			add(blank);
			extra = new JLabel(" Please choose an option below");
			blank1 = new JPanel();
			blank1.add(extra);
			add(blank1);
			
			createP = new JPanel(new FlowLayout(FlowLayout.LEFT));
			
			createAccount = new JRadioButton("Create Account", true);
			createAccount.addActionListener(this);
			sizeGroup.add(createAccount);
			createP.add(createAccount);
			
			add(createP);
			
			makeP = new JPanel(new FlowLayout(FlowLayout.LEFT));
			
			makeRes = new JRadioButton("Make A Reservation");
			makeRes.addActionListener(this);
			sizeGroup.add(makeRes);
			makeP.add(makeRes);
			
			add(makeP);
			
			cancP = new JPanel(new FlowLayout(FlowLayout.LEFT));
			
			cancelRes = new JRadioButton("Cancel A Reservation");
			cancelRes.addActionListener(this);
			sizeGroup.add(cancelRes);
			cancP.add(cancelRes);
			
			add(cancP);
			
			blank2 = new JPanel();
			add(blank2);
			
			blank3 = new JPanel();
			blank3.setLayout(new FlowLayout());
			add(blank3);
			
			next = new JButton("Next");
			next.addActionListener(this);
			blank3.add(next);	
			
			cancel = new JButton("Cancel");
			cancel.addActionListener(this);
			blank3.add(cancel);	
		}
		
		public void actionPerformed(ActionEvent e)
		{
			Object source = e.getSource();
	
			if(createAccount.isSelected()&&source==next)
			{			
				JFrame create = new RentalFrame();
				JPanel newCreate = new CreateAcct();
				create.add(newCreate);
				create.setVisible(true);			
			}
			else if(makeRes.isSelected()&&source==next)
			{
				JFrame make = new RentalFrame();
				JPanel newRes = new MakeReservation();
				make.add(newRes);
				make.setVisible(true);
			}
			else if(cancelRes.isSelected()&&source==next)
			{
				Login login = new Login();
				login.setVisible(true);
			}
			else if(source.equals(cancel))
			{
				System.exit(1);
			}
		}
	}
	
	private class CreateAcct extends JPanel implements ActionListener
	{
		private JTextField username;
		private JPasswordField pswrd;
		private JButton cont, cancel;
		private JPanel blank, nameP, passwordP, buttonP;
		private JFrame controllingFrame; 
		private JLabel nameLabel, passwordLabel;
		private int rand = 0;
		public CreateAcct()
		{
			JFrame f = new JFrame();
			controllingFrame=f;
			setLayout(new GridLayout(5, 1));
			nameP = new JPanel(new FlowLayout(FlowLayout.TRAILING));
			
			nameLabel = new JLabel("Username: ");
			nameLabel.setLabelFor(username);
			
			username = new JTextField(10);
			username.addActionListener(this);
			
			nameP.add(nameLabel);
			nameP.add(username);
			
			add(nameP);
			
			passwordP = new JPanel(new FlowLayout(FlowLayout.TRAILING));
			
			passwordLabel = new JLabel("Password: ");
			passwordLabel.setLabelFor(pswrd);
			passwordP.add(passwordLabel);
			
			pswrd = new JPasswordField(10);
			pswrd.addActionListener(this);
			passwordP.add(pswrd);
			
			add(passwordP);
			
			blank = new JPanel();
			add(blank);
			
			buttonP = new JPanel(new FlowLayout());
			
			cont = new JButton("Next");
			cont.addActionListener(this);
			//cont.setEnabled(false);
			buttonP.add(cont);		
			
			cancel= new JButton("Cancel");
			cancel.addActionListener(this);
			buttonP.add(cancel);
			
			add(buttonP);
		}
		public void actionPerformed(ActionEvent e)
		{
			Object source = e.getSource();	
			String name = new String(username.getText());
			String tempPass = new String(pswrd.getPassword());
			Account myAcct = new Account();
			Transaction trans;
			
			if(source == cont)
			{
				do
				{
					if(name.equals(null)&&tempPass.equals(null)&&rand<2)
					{
						JOptionPane.showMessageDialog(controllingFrame, "Please enter a username and password before continuing");
						rand++;
						
					}
	
					if(!findUsername(name))
					{	
						if((myAcct.checkPassword(tempPass)&&myAcct.checkUsername(name)))
						{
							myAcct.setName(name);
							myAcct.setPassword(tempPass);
							numAccounts++;
							numTransactions++;
							accounts.add(myAcct);
							trans = new Transaction(myAcct);
							transactions.add(trans);
							JOptionPane.showMessageDialog(controllingFrame, "Account Created Successfully at " +trans.toString());
				
						}
						else
						{
							JOptionPane.showMessageDialog(controllingFrame, "Invalid information entered. Please try again");
							username.setText("");
							pswrd.setText("");
							rand++;
							
							if(rand==2)
							{
								JOptionPane.showMessageDialog(controllingFrame, "Login Failed");
								SwingUtilities.getWindowAncestor(this).dispose();
							}
							return;	
							
						}
					}
					else
						JOptionPane.showMessageDialog(controllingFrame, "this account already Exists. Please try again");
						rand++;	
						
						if(rand==2)
						{
							JOptionPane.showMessageDialog(controllingFrame, "Login Failed");
							SwingUtilities.getWindowAncestor(this).dispose();
						}
				}while(!(myAcct.checkPassword(tempPass)&&myAcct.checkUsername(name))&&(rand <2));
				SwingUtilities.getWindowAncestor(this).dispose();
			}
			else if(source.equals(cancel))
			{
				username.setText("");
				pswrd.setText("");
				SwingUtilities.getWindowAncestor(this).dispose();
			}
		}
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
		for(int i = 0; i <numAccounts; i++)
		{
			if(accounts.get(i).getUsername().equals(temp))
				return accounts.get(i);
		}
		return null;
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
		System.out.print("checkReservedVcalled");
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

	private class Login extends JPanel implements ActionListener
	{
		private JTextField username;
		private JPasswordField pswrd;
		private JButton cont, cancel;
		private JPanel blank, nameP, passwordP, buttonP, main;
		private JFrame controllingFrame, f; 
		private JLabel nameLabel, passwordLabel;
		private Account temp;
		private boolean flag =false;
		public Login()
		{
			f = new JFrame("Login");
			f.setSize(200,200);
			f.setResizable(false);
			f.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
			centerWindow(f);
			controllingFrame=f;
			
			main = new JPanel(new GridLayout(5, 1));
			
			nameP = new JPanel(new FlowLayout(FlowLayout.TRAILING));
			
			nameLabel = new JLabel("Username: ");
			nameLabel.setLabelFor(username);
			
			username = new JTextField(10);
		
			
			nameP.add(nameLabel);
			nameP.add(username);
			
			main.add(nameP);
			
			passwordP = new JPanel(new FlowLayout(FlowLayout.TRAILING));
			
			passwordLabel = new JLabel("Password: ");
			passwordLabel.setLabelFor(pswrd);
			passwordP.add(passwordLabel);
			
			pswrd = new JPasswordField(10);
			
			passwordP.add(pswrd);
			
			main.add(passwordP);
			
			blank = new JPanel();
			main.add(blank);
			
			buttonP = new JPanel(new FlowLayout());
			cont = new JButton("Next");
			buttonP.add(cont);	
			cont.addActionListener(this);
			
			cancel= new JButton("Cancel");
			cancel.addActionListener(this);
			buttonP.add(cancel);
			
			main.add(buttonP);
			
			f.add(main);
			f.setVisible(true);
		
		}
	    private void centerWindow(Window w)
	    {
	        Toolkit tk = Toolkit.getDefaultToolkit();
	        Dimension d = tk.getScreenSize();
	        setLocation((d.width-w.getWidth())/2, (d.height-w.getHeight())/2);
	    }
	    private boolean isAdmin(String name, String password)
		{
			return(name.equals("admin2")&&password.equals("admin2"));
		}
		private void ManageSystem()
		{
			String name=null;
			String password=null;
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
		public void actionPerformed(ActionEvent e)
		{
			Object source = e.getSource();	
			String name = new String(username.getText());
			String tempPass = new String(pswrd.getPassword());
			
			int count=0;
			if(source.equals(cont))
			{			
				if(isAdmin(name, tempPass))
				{
					JFrame manage = new RentalFrame();
					JPanel manager = new ManageSystem();
					manage.add(manager);
					manage.setVisible(true);
				}
				else
				{
				while(!findUsername(name)&&count<2)
				{	
					if(name.equals(null)&&tempPass.equals(null)&&count<2)
					{
						JOptionPane.showMessageDialog(controllingFrame, "Please enter a username and password before continuing");
						count++;
					}
					JOptionPane.showMessageDialog(controllingFrame, "Invalid information entered. Please try again");
					username.setText("");
					pswrd.setText("");
					count++;
					
					if(count==2)
					{
						JOptionPane.showMessageDialog(controllingFrame, "Login Failed");
						f.dispose();
					}
					return;	
				}
					Account found = findAccount(name);
					if(!findAccount(name).equals(null))
					{
						JFrame cancel = new RentalFrame();
						JPanel cancelRes = new CancelReservation(found);
						cancel.add(cancelRes);
						cancel.setVisible(true);
					}
					else
						JOptionPane.showMessageDialog(controllingFrame, "Invalid account");
					f.dispose();
			}	
			}
			else if(source == cancel)
			{
				if(source == cancel)
					f.dispose();
			}
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
		public String getName()
		{
			String name = new String(username.getText());
			return name;
		}
		
		public String getPassword()
		{
			String tempPass = new String(pswrd.getPassword());
			return tempPass;
		}
		public Account getAccount()
		{
			return temp;
		}
		public boolean isSuccess()
		{
			return(flag == true);
		}
	}
	private class MakeReservation extends JPanel implements ActionListener
	{
		private JButton cont, cancel;
		private JPanel  buttonP, radioP, 
						menuP1, menuP2, 
						nameP, passwordP;
		private JTextField username;
		private JPasswordField pswrd;
		private JRadioButton sedan, truck, van;
		private JComboBox pickDay, dropDay,
						june1, june2, year1, year2;
		private JLabel select, pDate, rDate,
						nameLabel, passwordLabel;
		private JFrame controllingFrame; 
		private String date = "";
		public MakeReservation()
		{
			setLayout(new GridLayout(9, 1));
					
			
			select = new JLabel("Select a Vehicle Type: ");
			add(select);
			
			ButtonGroup radioGroup = new ButtonGroup();
			
			radioP = new JPanel(new FlowLayout());
			
			sedan = new JRadioButton("Sedan", true);
			sedan.addActionListener(this);
			radioGroup.add(sedan);
			radioP.add(sedan);
			
			truck = new JRadioButton("Truck");
			truck.addActionListener(this);
			radioGroup.add(truck);
			radioP.add(truck);
			
			van = new JRadioButton("Minivan");
			van.addActionListener(this);
			radioGroup.add(van);
			radioP.add(van);
			
			add(radioP);
			
			pDate = new JLabel("Please select a pick up date (m/d/y):");
			add(pDate);
			
			menuP1 = new JPanel(new FlowLayout());
			
			String[] months = {"June"};
			june1= new JComboBox(months);
			june1.addActionListener(this);
			
			String[] days={"1","2","3","4","5","6","7","8","9","10", "11","12","13","14","15",
					"16","17","18","19","20","21","22","23","24","25","26","27","28","29","30"};
			pickDay = new JComboBox(days);
			pickDay.addActionListener(this);
			
			String[] years={"2012"};
			year1 = new JComboBox(years);
			year1.addActionListener(this);
			
			menuP1.add(june1);
			menuP1.add(pickDay);
			menuP1.add(year1);
			
			add(menuP1);
			
			rDate = new JLabel("Please select a drop off date (m/d/y):");
			add(rDate);
			
			menuP2 = new JPanel(new FlowLayout());
			
			june2= new JComboBox(months);
			june2.addActionListener(this);
			dropDay = new JComboBox(days);
			dropDay.addActionListener(this);
			year2 = new JComboBox(years);
			year2.addActionListener(this);
			
			menuP2.add(june2);
			menuP2.add(dropDay);
			menuP2.add(year2);
			
			add(menuP2);
			
			nameLabel = new JLabel("Username: ");
			nameLabel.setLabelFor(username);
			
			username = new JTextField(10);
			username.addActionListener(this);
			
			nameP=new JPanel(new FlowLayout());
			nameP.add(nameLabel);
			nameP.add(username);
			
			add(nameP);
			
			passwordP = new JPanel(new FlowLayout(FlowLayout.TRAILING));
			
			passwordLabel = new JLabel("Password: ");
			passwordLabel.setLabelFor(pswrd);
			passwordP.add(passwordLabel);
			
			pswrd = new JPasswordField(10);
			pswrd.addActionListener(this);
			passwordP.add(pswrd);
			
			add(passwordP);
			
			buttonP = new JPanel(new FlowLayout());
			
			cont = new JButton("Next");
			cont.addActionListener(this);
			buttonP.add(cont);		
			
			cancel= new JButton("Cancel");
			cancel.addActionListener(this);
			buttonP.add(cancel);
			
			add(buttonP);		
			
			
		}
		public void actionPerformed(ActionEvent e)
		{
			Object source = e.getSource();	
			String pickup = pickDay.getSelectedItem().toString();
			String dropOff = dropDay.getSelectedItem().toString();
			int pickUpDay = Integer.parseInt(pickup);
			int returnDay = Integer.parseInt(dropOff);
			String name = new String(username.getText());
			String tempPass = new String(pswrd.getPassword());
			Transaction trans;
			int rand=0;			
			Reservation myRes = new Reservation();
			int choice=0;
			if(source == cont)
			{
				if(sedan.isSelected())
					choice =1;
				else if(van.isSelected())
					choice = 2;
				else if(truck.isSelected())
					choice = 3;
				do
				{
					JOptionPane.showMessageDialog(controllingFrame, "Invalid dates. Please select a valid pickup and return day.");
					
					if(!isValidDate(pickUpDay, returnDay)&&rand==2)
					{
						System.out.println("Reservation attempt failed");
						SwingUtilities.getWindowAncestor(this).dispose();
					}
					rand++;
				}while(!isValidDate(pickUpDay, returnDay)&&rand<2);
			
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
				while(!findUsername(name)&&rand<2)
				{	
					if(name.equals(null)&&tempPass.equals(null)&&rand<2)
					{
						JOptionPane.showMessageDialog(controllingFrame, "Please enter a username and password before continuing");
						rand++;
					}
					JOptionPane.showMessageDialog(controllingFrame, "Invalid information entered. Please try again");
					username.setText("");
					pswrd.setText("");
					rand++;
					
					if(rand==2)
					{
						JOptionPane.showMessageDialog(controllingFrame, "Login Failed");
						SwingUtilities.getWindowAncestor(this).dispose();
					}
					return;	
				}
					
					//also for the string date, for checking if a vehicle is reserved for this time period
					if(choice == 1)
						date+="S";
					if(choice ==2)
						date+="V";
					if(choice==3)
						date+="T";
					dates.add(date);
					Account found = findAccount(name);
					if(!found.equals(null))//check if user chooses to make a reservation first.
					{
						myRes = new Reservation(choice, pickUpDay, returnDay, found);
						numReservations++;
						reservations.add(myRes);
						trans = new Transaction(myRes);
						numTransactions++;
						transactions.add(trans);
						JOptionPane.showMessageDialog(controllingFrame, "Reservation made!" + myRes.toString());
						
					}
					else
						JOptionPane.showMessageDialog(controllingFrame, "Invalid Account.");
					SwingUtilities.getWindowAncestor(this).dispose();
			}
			else
				JOptionPane.showMessageDialog(controllingFrame, "Invalid Vehicle Choice");
			}

			else if(source == cancel)
			{
				SwingUtilities.getWindowAncestor(this).dispose();
			}
		}
	}
	private class ManageSystem extends JPanel implements ActionListener
	{
		private JButton exit;
		private JList transList;
		private JLabel trans;
		private JPanel b1, b2, b3;
		private DefaultListModel list;
		ManageSystem()
		{
			list = new DefaultListModel();
			for(int i = 0; i < numTransactions; i++)
			{
				list.addElement(transactions.get(i));
			}
			transList = new JList(list);
			
			b1= new JPanel(new BorderLayout());
			trans = new JLabel("Transactions: ");
			exit = new JButton("Exit");
			b1.add(trans, BorderLayout.NORTH);
			exit.addActionListener(this);
			b1.add(exit, BorderLayout.SOUTH);
			b1.add(transList, BorderLayout.CENTER);
			add(b1);
		}
		public void actionPerformed(ActionEvent e)
		{
			Object source = e.getSource();	
			if(source == exit)
			{
				SwingUtilities.getWindowAncestor(this).dispose();
			}			
		}
	}
	private class CancelReservation extends JPanel implements ActionListener
	{
		private DefaultListModel listRes;
		private JList dList;
		private JButton ok, canc;
		private JLabel prompt;
		private JPanel buttonP, blankP;
		private Account myAcct;
		private JFrame controllingFrame;
		private int check;
		public CancelReservation(Account acct)
		{
			myAcct = acct;
			check = 0;
			setLayout(new GridLayout(5,1));
			prompt = new JLabel("Please select the reservation you wish to cancel: ");
			add(prompt);
			listRes = new DefaultListModel();
			for(int i = 0;i<numReservations;i++)
			{
				if(reservations.get(i).getAccout().equals(myAcct))
				{
					JOptionPane.showMessageDialog(controllingFrame, reservations.get(i).toString());
					listRes.addElement(reservations.get(i));
					check++;
				}
			}
			dList = new JList(listRes);
			
			add(dList);
			
			blankP = new JPanel(new FlowLayout());
			add(blankP);
			
			buttonP = new JPanel();
			
			ok = new JButton("Submitt");
			ok.addActionListener(this);
			buttonP.add(ok);
			
			canc = new JButton("Cancel");
			canc.addActionListener(this);
			buttonP.add(canc);
			
			add(buttonP);
		}
		
		public void actionPerformed(ActionEvent e)
		{
			Object source = e.getSource();	
			Transaction trans;
			if(source == ok)
			{
				for(int i = 0; i <check; i++)
				{
					String s1 =  reservations.get(i).toString();
					
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
					trans = new Transaction("Cancelation", s1);
					numTransactions++;
					transactions.add(trans);
					
					dList.getSelectedValue();
					reservations.remove(dList.getSelectedValue());
					numReservations--;
					JOptionPane.showMessageDialog(controllingFrame, "Reservation canceled: " + dList.getSelectedValue().toString());
					listRes.removeElement(dList.getSelectedValue());
				}
				SwingUtilities.getWindowAncestor(this).dispose();
				
			}
			else if(source == canc)
			{
				listRes.clear();
				SwingUtilities.getWindowAncestor(this).dispose();
			}
		}
	}
}