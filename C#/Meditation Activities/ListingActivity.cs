using System;

class ListingActivity : Activity
{
    private int _listedItemsCount;
    private List<string> _promptList = new List<string> { "Who are people that you appreciate?", "What are personal strengths of yours?", "Who are people that you have helped this week?", "When have you felt the Holy Ghost this month?", "Who are some of your personal heroes?" };
    public ListingActivity(string activityType, string description) : base(activityType, description)
    {
    }
    public void Prompt()
    {
        Console.WriteLine("Get ready... ");
        LoadingAnimation();
        Console.WriteLine("List as many responses you can to the following prompt");
        Console.WriteLine("");
        Console.WriteLine($"---{ReturnRandomPrompt(_promptList)}");
        Console.WriteLine("You may bein in: ");
        NumberCountDown(5);

        DateTime startTime = DateTime.Now;
        DateTime futureTime = startTime.AddSeconds(_specifiedTime);
        DateTime currentTime = DateTime.Now;

        while (currentTime <= futureTime)
        {
            Console.Write("> ");
            Console.ReadLine();
            _listedItemsCount++;
            currentTime = DateTime.Now;
        }
        Console.WriteLine($"You listed {_listedItemsCount} items! ");
        DisplayEnd();
    }
}