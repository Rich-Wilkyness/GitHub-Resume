using System;

class Reference
{
    private string _book;
    private string _chapter;
    private string _startVerse;
    private string _endVerse;
    public Reference(string book, string chapter, string verse)
    {
        _book = book;
        _chapter = chapter;
        _startVerse = verse;
        _endVerse = null;
    }
    public Reference(string book, string chapter, string startVerse, string endVerse)
    {
        _book = book;
        _chapter = chapter;
        _startVerse = startVerse;
        _endVerse = endVerse;
    }
    public void DisplayReference()
    {
        if (_endVerse != null)
        {
            Console.Write($"{_book} {_chapter}:{_startVerse}-{_endVerse} ");
        }
        else
        {
            Console.Write($"{_book} {_chapter}:{_startVerse} ");
        }
    }
}