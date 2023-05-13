using System;

class Scripture
{
    private string _scripture;
    private Reference _reference;

    private string[] _splitScripture;
    private int _scriptureLength;

    public Scripture(string scripture, Reference reference)
    {
        _scripture = scripture;
        _reference = reference;
        SplitScripture();
        _scriptureLength = _splitScripture.Length;
    }
    private void SplitScripture()
    {
        string _trimmedScripture = _scripture.Trim();
        _splitScripture = _trimmedScripture.Split();
        _scriptureLength = _splitScripture.Length;
    }
    public int GetScriptureLength()
    {
        return _scriptureLength;
    }
    public void DisplayScripture(List<int> indexes)
    {
        for (int i = 0; i < _scriptureLength; i++)
        {
            bool hidden = true;
            for (int j = 0; j < indexes.Count; j++)
            {
                if (indexes[j] == i)
                {
                    hidden = false;
                }
            }
            if (hidden == true)
            {
                Console.Write(_splitScripture[i]);
                Console.Write(" ");
            }
            else if (hidden == false)
            {
                Console.Write($"_{i}_ ");
            }
        }
        Console.WriteLine("");
    }
    public void DisplayHint(int number)
    {
        Console.WriteLine(_splitScripture[number]);
    }
}