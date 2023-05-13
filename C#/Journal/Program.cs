using System;

class Program
{
    static void Main(string[] args)
    {
        string menu = "0";
        Prompt prompt = new Prompt();
        Journal journal = new Journal();
        journal._wantsReminder = "N";
        while (menu != "6")
        {
            journal.JournalReminder();
            Console.WriteLine("1. Write an entry");
            Console.WriteLine("2. Display journal");
            Console.WriteLine("3. Save journal");
            Console.WriteLine("4. Load journal");
            Console.WriteLine("5. Add reminder notification");
            Console.WriteLine("6. Quit");
            Console.Write("What would you like to do? ");
            menu = Console.ReadLine();

            if (menu == "1")
            {
                Entry entry = new Entry();
                entry._prompt = prompt.DisplayRandomPrompt();
                entry._entry = Console.ReadLine();
                entry._date = entry.GetDateTime();

                journal._entries.Add(entry);
            }
            else if (menu == "2")
            {
                journal.DisplayJournal();
            }
            else if (menu == "3")
            {
                Console.Write("Name your journal (add .txt to the end): ");
                journal._fileName = Console.ReadLine();
                journal.SaveToFile();

            }
            else if (menu == "4")
            {
                Console.Write("What is the name of the file? ");
                journal._fileName = Console.ReadLine();
                journal = journal.LoadFromFile();
            }
            else if (menu == "5")
            {
                Console.Write("Would you like to add a daily journal reminder? (Y/N)");
                journal._wantsReminder = Console.ReadLine();
            }
            else if (menu == "6")
            {
                Console.WriteLine("Thank you for journaling");
            }

        }
    }
}

// random prompt - from array, save prompt, response and date
// display the journal
// save journal to a file
// load journal from a file
// menu (Write, Display, Save, Load, Quit?)

// prompts