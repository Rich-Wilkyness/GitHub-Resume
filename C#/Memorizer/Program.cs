using System;

class Program
{
    static void Main(string[] args)
    {
        Console.Write("Book: ");
        string book = Console.ReadLine();
        Console.Write("Chapter: ");
        string chapter = Console.ReadLine();
        Console.Write("Start Verse (number): ");
        string verseStart = Console.ReadLine();
        Console.Write("End verse (if nonapplicable, enter 'none'): ");
        string verseEnd = Console.ReadLine();
        Console.Write("Scripture verse: ");
        string scriptureVerse = Console.ReadLine();

        Reference reference;
        Scripture scripture;

        if (verseEnd.ToLower() == "none")
        {
            reference = new Reference(book, chapter, verseStart);
            scripture = new Scripture(scriptureVerse, reference);
        }
        else
        {
            reference = new Reference(book, chapter, verseStart, verseEnd);
            scripture = new Scripture(scriptureVerse, reference);
        }
        // Reference reference = new Reference(book, chapter, verseStart, verseEnd);
        // Scripture scripture = new Scripture(scriptureVerse, reference);
        RandomIndex randomIndex = new RandomIndex();

        while (true)
        {
            Console.WriteLine("");
            Console.Write("Press 'enter' to go next, the number of the desired word, or 'quit' to end. ");
            string option = Console.ReadLine();
            int number;
            // if (option.ToLower() == "prev")
            // {
            //     Console.Clear();
            //     scripture.DisplayScripture(randomIndex.GetPreviousIndexes());
            // }
            if (option.ToLower() == "quit")
            {
                Console.WriteLine("See you later!");
                break;
            }
            else if (int.TryParse(option, out number))
            {
                scripture.DisplayHint(number);
            }
            else
            {
                Console.Clear();
                // randomIndex.UpdatePreviousIndex();
                reference.DisplayReference();
                randomIndex.AddRandomIndex(scripture.GetScriptureLength());
                scripture.DisplayScripture(randomIndex.GetCurrentIndexes());
            }
        }
    }
}