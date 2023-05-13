using System;

public class Entry
{
    public string _entry;
    public string _prompt;
    public string _date;
    public string GetDateTime()
    {
        DateTime theCurrentTime = DateTime.Now;
        string dateText = theCurrentTime.ToShortDateString();
        return dateText;
    }

    public void DisplayEntry()
    {
        Console.WriteLine($"{_date} {_prompt} {_entry}");
    }
}