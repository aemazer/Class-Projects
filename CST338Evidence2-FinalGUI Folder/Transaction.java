/*Project Name: Project2_Mazer, Transaction.java
 * Abstract: This is a class meant to help RentalCarSim.java.
 * 			holds information for each transaction. Requires Account.java
 * 			and Reservation.java to run correctly.
 * ID: 0338
 * Name: Ariana Mazer
 * Date: 5.9.2012
 */
import java.util.Date;
import java.text.DateFormat;
import java.text.SimpleDateFormat;

public class Transaction
{
	private static int transNum=1000;
	DateFormat dateFormat = new SimpleDateFormat("yyyy/MM/dd HH:mm:ss");
	private Date date;
	private String type;
	private Account linked;
	private Reservation reservation;
	private String canceled;
	public Transaction()
	{
		date = new Date();
		transNum=updateTransactionNum();
	}
	public String getType()
	{
		return type;
	}
	public void setType(String type)
	{
		if(type.equals("New Account")||type.equals("Reservation")||type.equals("Cancelation"))
		{
			this.type=type;
		}
		else
			System.out.print("Invalid type");//for me
	}
	public Transaction(Account linked)
	{
		date = new Date();
		this.linked=linked;
		transNum=updateTransactionNum();
		type = "New Account";
	}
	public Transaction(Reservation reservation)
	{
		date = new Date();
		this.reservation=reservation;
		transNum=updateTransactionNum();
		type = "Reservation";
	}
	public Transaction(String cancelation, String canceled)
	{
		date = new Date();
		transNum = updateTransactionNum();
		type = cancelation;
		this.canceled=" Transaction number: "+ transNum + " "  + type + ":\n " + canceled;
	}

	public Date getDate()
	{
		return this.date;
	}
	public int updateTransactionNum()
	{
		int temp=transNum;
		temp++;
		transNum=temp;
		return temp;
	}
	public Account getAccount()
	{
		return linked;
	}
	public int getNumber()
	{
		return transNum;
	}
	public String toString()
	{
		String s1 = getDate().toString();
		if(type.equals("New Account"))
		{
			s1+=", Transaction Number: "+linked.getTransNum() +", " +type + ": " + linked.getUsername();
			//linked.print();
		}
			
		if(type.equals("Reservation"))
		{
			s1+=", Transaction Number: "+reservation.getTransNum() +", " +type +": " + reservation.toString();//works
			//reservation.print();//works
		}
		if(type.equals("Cancelation"))
		{
			s1+=", "+canceled;
		}
		return s1;
	}
	public void print()
	{
		System.out.print(date);
		if(type.equals("New Account"))
		{
			System.out.print(", Transaction Number: "+linked.getTransNum() +", " +type + ": " );
			linked.print();
		}
			
		if(type.equals("Reservation"))
		{
			System.out.print(", Transaction Number: "+reservation.getTransNum() +", " +type +": ");//works
			reservation.print();//works
		}
		if(type.equals("Cancelation"))
		{
			System.out.print(", "+canceled);
		}
	}

}
