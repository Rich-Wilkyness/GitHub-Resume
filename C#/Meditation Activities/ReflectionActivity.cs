using System;

class ReflectionActivity : Activity
{
    private int _index;
    private List<int> _usedIndexes = new List<int> { };
    private List<string> _promptList = new List<string> { "Think of a time when you stood up for someone else.", "Think of a time when you did something really difficult.", "Think of a time when you helped someone in need.", "Think of a time when you did something truly selfless." };
    private List<string> _relateList = new List<string> { "Why was this experience meaningful to you?", "Have you ever done anything like this before?", "How did you get started?", "How did you feel when it was complete?", "What made this time different than other times when you were not as successful?", "What is your favorite thing about this experience?", "What could you learn from this experience that applies to other situations?", "What did you learn about yourself through this experience?", "How can you keep this experience in mind in the future?" };
    public ReflectionActivity(string activityType, string description) : base(activityType, description)
    {
    }
    public string NonRepeatReturnRandomPrompt(List<string> inputList)
    {
        bool keepGoing = true;
        while (keepGoing == true)
        {
            var random = new Random();

            _index = random.Next(inputList.Count);

            keepGoing = false;
            foreach (int i in _usedIndexes)
            {
                if (i == _index)
                {
                    keepGoing = true;
                }
            }
        }
        _usedIndexes.Add(_index);
        return inputList[_index];
    }
    public void Prompt()
    {
        Console.WriteLine("Get ready...");
        LoadingAnimation();
        Console.WriteLine($"--- {ReturnRandomPrompt(_promptList)} ---");
        Console.WriteLine("");
        Console.WriteLine("When you have something in mind, press enter to continue. ");
        Console.ReadLine();

        DateTime startTime = DateTime.Now;
        DateTime futureTime = startTime.AddSeconds(_specifiedTime);
        DateTime maxTime = startTime.AddSeconds(81); //length of list * NumberCountDown in reflect
        DateTime currentTime = DateTime.Now;
        while (currentTime <= futureTime && currentTime < maxTime)
        {
            Reflect();
            currentTime = DateTime.Now;
        }
        DisplayEnd();
    }
    public void Reflect()
    {
        Console.WriteLine(NonRepeatReturnRandomPrompt(_relateList));
        NumberCountDown(9);
    }
}