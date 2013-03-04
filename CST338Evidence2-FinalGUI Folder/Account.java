/*Project Name: Project2_Mazer, Account.java
 * Abstract: This is a class meant to help RentalCarSim.java.
 * 			holds information for each Account. Requires Transaction.java
 * 			to run
 * ID: 0338
 * Name: Ariana Mazer
 * Date: 5.9.2012
 */
import java.util.ArrayList;
public class Account 
{
	private String userName;
	private String password;
	private Transaction transaction;
	private int transNum;
	public Account()
	{
		userName = null;
		password = null;
		transaction = new Transaction(this);
		transNum=transaction.getNumber();
	}
	public Account(String username, String password)
	{
		setName(username);
		setPassword(password);
		transaction = new Transaction(this);
		transNum=transaction.getNumber();
	}
	public String getUsername()
	{
		return userName;
	}
	
	public String getPassword()
	{
		return password;
	}
	
	public void setName(String userName)
	{
		this.userName=userName;
	}
	
	public void setPassword(String password)
	{
		this.password=password;
	}
	
	public boolean checkUsername(String userName)
	{
		return(!userName.equals("admin2")&&userName.length()>=5);
	}
	public boolean checkPassword(String password)
	{
		String admin = "admin2";
		if(!password.equals(admin)&&password.length()>=5)
			return true;
		return false;
	}
	public int getTransNum()
	{
		return transNum;
	}
	public void print()
	{
		System.out.print(userName + " ");
	}
	
}
