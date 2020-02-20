import java.util.Scanner;

public class Maths2{
    double num = 0.0;
    public static void main(String[] args){
        Maths2 m2 = new Maths2();
        m2.answer();
    }
    public double getSqr(double num1) {
        if(num1 == 0)
            return 0;
        else
            return getSqr(num1-1) + (2* num1) -1;
    }
    public double getCube(double num2) {
        if(num2 == 0)
            return 0;
        else
            return getCube(num2-1) + 3*(getSqr(num2)) -3*num2 + 1;
    // Ex1 : getCube() method calling itself, is an example for a recursive call.
    // Ex2 : getCube() method calling the getSqr() method, is an example for a recursive method calling another recursive method in the same file.
    }

    public void answer(){
        Maths2 m1 = new Maths2();

        Scanner input = new Scanner(System.in);
        System.out.print("Enter a number:");
        num = input.nextInt();
    // Ex3: answer() method calling referencing 'num' varialble, is an example for a regular method referencing a global varialble in the same file.

    double n2 = m1.getSqr(num);
    // Ex4: answer() method calling the getSqr() method, is an example for a regular method calling a recursive method in the same file.

    System.out.println("Squared value of " + num + " is "+ n2);
    System.out.println("Cube value of " + num + " is " + m1.getCube(num));  
    }
}