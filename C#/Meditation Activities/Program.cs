using System;

class Program
{
    static void Main(string[] args)
    {
        while (true)
        {
            Console.WriteLine("Menu Options: ");
            Console.WriteLine(" 1. Breathing Activity ");
            Console.WriteLine(" 2. Reflection Activity ");
            Console.WriteLine(" 3. Listing Activity ");
            Console.WriteLine(" 4. Quit ");
            Console.WriteLine("Select a choice from the menu: ");
            string activityChoice = Console.ReadLine();

            if (activityChoice == "1")
            {
                BreathingActivity breathing = new BreathingActivity("Breathing Activity", "This activity will help you relax by walking your through breathing in and out slowly. Clear your mind and focus on your breathing.");

                breathing.DisplayStart();
                string strSpecifiedTime = Console.ReadLine();
                int specifiedTime = int.Parse(strSpecifiedTime);
                breathing.SetSpecifiedTime(specifiedTime);

                breathing.Prompt();
            }
            else if (activityChoice == "2")
            {
                // I exceeded the requirements under the Reflection activity by not displaying the same reflect prompt more than once. 
                ReflectionActivity reflection = new ReflectionActivity("Reflection Activity", "This activity will help you reflect on times in your life when you have shown strength and resilience. This will help you recognize the power you have and how you can use it in other aspects of your life.");
                reflection.DisplayStart();
                string strSpecifiedTime = Console.ReadLine();
                int specifiedTime = int.Parse(strSpecifiedTime);
                reflection.SetSpecifiedTime(specifiedTime);

                reflection.Prompt();
            }
            else if (activityChoice == "3")
            {
                ListingActivity listing = new ListingActivity("Listing Activity", "This activity will help you reflect on the good things in your life by having you list as many things as you can in a certain area.");
                listing.DisplayStart();
                string strSpecifiedTime = Console.ReadLine();
                int specifiedTime = int.Parse(strSpecifiedTime);
                listing.SetSpecifiedTime(specifiedTime);

                listing.Prompt();
            }
            else if (activityChoice == "4")
            {
                break;
            }
        }
    }
}