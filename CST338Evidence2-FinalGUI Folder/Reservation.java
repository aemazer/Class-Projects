/*Project Name: Project2_Mazer, Reservation.java
 * Abstract: This is a class meant to help RentalCarSim.java.
 * 			holds information for each reservation. Requires Transaction.java
 * 			and ccount.java to run
 * ID: 0338
 * Name: Ariana Mazer
 * Date: 5.9.2012
 */
public class Reservation
{
	private String typeCar;
	private double vehiclePrice;
	private double totalPrice;
	private String pickupDate;
	private String returnDate;
	private int pickupDay;
	private int dropoffDay;
	private Transaction transaction;
	private int transNum;
	private int resNum=10;
	private Account account;
	private int vehicleTypeNum=0;
	public Reservation()
	{
		typeCar = null;
		vehiclePrice = 0.0;
		totalPrice = 0.0;
		pickupDay = 1;
		dropoffDay=30;
		pickupDate = "June" + " "+  pickupDay + " " +  2012;
		returnDate = "June" + " "+  dropoffDay +" " +  2012;
		transaction = new Transaction(this);
		transNum=transaction.getNumber();
		resNum+=transNum;
	}
	public Reservation(int type, int pickUp, int dropOff, Account account)
	{
		typeCar=setType(type);
		vehiclePrice=setPrice();
		totalPrice=0.0;
		pickupDay=pickUp;
		dropoffDay=dropOff;
		setPickupDate(pickUp);
		setReturnDate(dropOff);
		transaction = new Transaction(this);
		transNum=transaction.getNumber();
		resNum+=transNum;
		this.account=account;
	}
	public Account getAccout()
	{
		return account;
	}
	public String getType()
	{
		return typeCar;
	}
	
	public String setType(int num)
	{
		if(num == 1)
			typeCar="Sedan";
		else if(num == 2)
			typeCar = "Minivan";
		else if(num == 3)
			typeCar = "Truck";
		else
			System.out.print("Invalid type");
		return typeCar;
	}
	public int getVTypeNum()
	{
		if(typeCar.equals("Sedan"))
			vehicleTypeNum=1;
		else if(typeCar.equals("Minivan"))
			vehicleTypeNum=2;
		else if(typeCar.equals("Truck"))
			vehicleTypeNum=3;
		else
			System.out.print("Invalid type");
		return vehicleTypeNum;
	}
	public double setPrice()
	{
		if(typeCar.equals("Sedan"))
			vehiclePrice = 25.00;
		else if(typeCar.equals("Minivan"))
			vehiclePrice = 50.00;
		else if(typeCar.equals("Truck"))
			vehiclePrice =35.00;
		else
			System.out.print("Invalid information");
		return vehiclePrice;
	}
	public int getPickupDay()
	{
		return pickupDay;
	}
	public int getReturnDay()
	{
		return dropoffDay;
	}
	public String getPickupDate()
	{
		return pickupDate;
	}
	public String getReturnDate()
	{
		return returnDate;
	}
	public void setPickupDate(int day)
	{
		pickupDay = day;
		pickupDate = "June " +  pickupDay + ", " +  2012;
	}
	public void setReturnDate(int day)
	{
		dropoffDay = day;
		returnDate = "June " +  dropoffDay + ", " +  2012;
	}
	public boolean validDates(int Pday, int Dday)
	{
		if(Pday > Dday)
			return false;
		return true;
	}
	public double calculateTotal()
	{
		double numDays = this.dropoffDay - this.pickupDay;
		totalPrice = setPrice()*numDays;
		if(numDays==0)
			totalPrice = setPrice();
		return totalPrice;
	}
	public int getTransNum()
	{
		return transNum;
	}

	public int getResNum()
	{
		return resNum;
	}
	public String toString()
	{
		String s1 = " Vehicle: " + getType() + " Pickup Date: " + getPickupDate() + " Return Date: " +
				getReturnDate() + "\n Total Price: " + calculateTotal() + 
				"\n Reservation number: " + resNum;
		return s1;
	}
	public void print()
	{
		System.out.println(" Vehicle: " + getType() + " Pickup Date: " + getPickupDate() + " Return Date: " +
							getReturnDate() + "\n Total Price: " + calculateTotal() + 
							"\n Reservation number: " + resNum);	
	}
	
}
