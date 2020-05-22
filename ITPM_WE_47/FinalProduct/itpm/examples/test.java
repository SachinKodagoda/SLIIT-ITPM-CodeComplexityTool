import java.util.Scanner;

public class Maths2 extends JumpingBox implements Dammed{
    double num = 0.0;
    int[] myNum;
    int back[];
    List<String> al=new ArrayList<String>();  
    HashMap<String, String> capitalCities = new HashMap<String, String>();
    Hashtable<Integer,String> ht=new Hashtable<Integer,String>();
    TreeMap<Integer, String> tree_map = new TreeMap<Integer, String>();
    LinkedHashMap<Integer,String> hm=new LinkedHashMap<Integer,String>();
    Map<Integer,String> map=new LinkedHashMap<Integer,String>();

    public static void main(String[] args) {
        double x , z, y = 3;
        int xs;
        xs = 3;
        Maths2 m2 = new Maths2();
        m2.answer();
    }

    public double getSqr(double num1) {
        if (num1 == 0)
            return 0;
        else {
            return getSqr(num1 - 1) + (2 * num1) - 1;
        }

    }

    public double getCube(double num2) {
        int i = 0;
        while (i < 3)
            System.out.println(i);
        while (i < 3) {
            System.out.println(i);
        }
        if (num2 == 0)
            return 0;
        else
            return getCube(num2 - 1) + 3 * (getSqr(num2)) - 3 * num2 + 1;
        // Ex1 : getCube() method calling itself, is an example for a recursive call.
        // Ex2 : getCube() method calling the getSqr() method, is an example for a
        // recursive method calling another recursive method in the same file.

        do {
            System.out.println(i);
            i++;
        } while (i < 5);
    }

    public void answer() {
        Maths2 m1 = new Maths2();
        String s = "";
        String xxs = " ";

        String[] cars = {"Volvo", "BMW", "Ford", "Mazda"};

        int[][] myNumbers = { {1, 2, 3, 4}, {5, 6, 7} };

        int[ ] myNum = {10, 20, 30, 40};
        int[5 ] myNum;

        Scanner input = new Scanner(System.in);
        System.out.print("Enter a number:");
        num = input.nextInt();
        // Ex3: answer() method calling referencing 'num' varialble, is an example for a
        // regular method referencing a global varialble in the same file.

        double n2 = m1.getSqr(num);
        // Ex4: answer() method calling the getSqr() method, is an example for a regular
        // method calling a recursive method in the same file.

        System.out.println("Squared value of " + num + " is " + n2 + "");
        System.out.println("Cube value of " + num + " is " + m1.getCube(num));
    }
}