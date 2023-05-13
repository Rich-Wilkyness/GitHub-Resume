using System;

class Activity
{
    private string _activityType;
    private string _description;
    protected int _specifiedTime;
    public Activity(string activityType, string description)
    {
        _activityType = activityType;
        _description = description;
    }
    public void SetSpecifiedTime(int specifiedTime)
    {
        _specifiedTime = specifiedTime;
    }
    public void DisplayStart()
    {
        Console.WriteLine("");
        Console.WriteLine($"Welcome to the {_activityType}.");
        Console.WriteLine("");
        Console.WriteLine($"{_description}");
        Console.WriteLine("");
        Console.Write("How long, in seconds, would you like for your session? ");
    }
    public void DisplayEnd()
    {
        Console.WriteLine("");
        Console.WriteLine("Well done!!");
        LoadingAnimation();
        Console.WriteLine($"You have completed another {_specifiedTime} seconds of the {_activityType}");
        LoadingAnimation();
        Console.ReadLine();
    }
    public void LoadingAnimation()
    {
        List<string> animationPieces = new List<string> { "/", $"{(char)0x2014}", @"\", "|", "/", $"{(char)0x2014}", @"\", "|" };
        foreach (string piece in animationPieces)
        {
            Console.Write(piece);
            Thread.Sleep(500);
            Console.Write("\b \b");
        }
        Console.WriteLine("");
    }
    public void NumberCountDown(int startNumber)
    {
        if (startNumber <= 0)
        {
            return;
        }
        while (startNumber != 0)
        {
            Console.Write(startNumber);
            Thread.Sleep(1000);
            Console.Write("\b \b");
            startNumber--;
        }
    }
    public string ReturnRandomPrompt(List<string> inputList)
    {
        var random = new Random();
        int index = random.Next(inputList.Count);
        return inputList[index];
    }
}