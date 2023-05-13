using System;

class BreathingActivity : Activity
{
    public BreathingActivity(string activityType, string description) : base(activityType, description)
    {
    }
    public void Prompt()
    {
        Console.WriteLine("Get ready... ");
        LoadingAnimation();

        DateTime startTime = DateTime.Now;
        DateTime futureTime = startTime.AddSeconds(_specifiedTime);
        DateTime currentTime = DateTime.Now;

        while (currentTime <= futureTime)
        {
            Breathe();
            currentTime = DateTime.Now;
        }
        DisplayEnd();
    }
    public void Breathe()
    {
        if (_specifiedTime < 10)
        {
            decimal number = decimal.Parse(_specifiedTime.ToString());
            decimal cieling = Math.Ceiling(number / 2);
            int intCieling = int.Parse(cieling.ToString());
            decimal floor = Math.Floor(number / 2);
            int intFloor = int.Parse(floor.ToString());
            Console.Write("Breath in... ");
            NumberCountDown(intCieling);
            Console.WriteLine("");
            Console.Write("Now breathe out...");
            NumberCountDown(intFloor);
            Console.WriteLine("");
        }
        else
        {
            Console.Write("Breath in... ");
            NumberCountDown(5);
            Console.WriteLine("");
            Console.Write("Now breathe out...");
            NumberCountDown(5);
            Console.WriteLine("");
            Console.WriteLine("");
        }
    }
}