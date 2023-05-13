using System;
using System.IO;
using System.Collections.Generic;

public class Journal
{
    public string _fileName;
    public string _wantsReminder;
    public string _dateReminder;
    public List<Entry> _entries = new List<Entry> { };

    public void DisplayJournal()
    {
        foreach (Entry entry in _entries)
        {
            entry.DisplayEntry();
        }
    }

    public void SaveToFile()
    {
        using (StreamWriter outputFile = new StreamWriter(_fileName))
        {
            for (int i = 0; i < _entries.Count; i++)
            {
                outputFile.Write(_entries[i]._date);
                outputFile.Write(" *");
                outputFile.Write(_entries[i]._prompt);
                outputFile.Write(" *");
                outputFile.Write(_entries[i]._entry);
                outputFile.Write(" *");
                outputFile.WriteLine(_wantsReminder);
            }
        }
    }

    public Journal LoadFromFile()
    {
        string[] lines = System.IO.File.ReadAllLines(_fileName);
        Journal journal = new Journal();
        foreach (string line in lines)
        {
            Entry entry = new Entry();
            string[] splitLine = line.Split("*");
            entry._date = splitLine[0];
            entry._prompt = splitLine[1];
            entry._entry = splitLine[2];
            journal._wantsReminder = splitLine[3];
            journal._entries.Add(entry);
        }
        return journal;
    }
    public void JournalReminder()
    {
        if (_wantsReminder == "Y")
        {
            Entry timeEntry = new Entry();
            int lastEntry = _entries.Count - 1;

            string currentTime = timeEntry.GetDateTime();

            TimeSpan interval = DateTime.Parse(currentTime) - DateTime.Parse(_entries[lastEntry]._date);
            if (interval.Days >= 1)
            {
                Console.WriteLine($"It has been {interval.Days} days since your last entry, try a prompt! ");
            }
            else
            {
                Console.WriteLine($"It has been less than a day since your last entry. ");
            }
        }
    }
}