using System;

class RandomIndex
{
    private int _index;
    private List<int> _currentIndexes = new List<int>();
    // private List<int> previousIndexes = new List<int>();


    public void AddRandomIndex(int scriptureLength)
    {
        bool keepGoing = true;
        while (keepGoing == true)
        {
            var random = new Random();

            _index = random.Next(scriptureLength);

            keepGoing = false;
            foreach (int i in _currentIndexes)
            {
                if (i == _index)
                {
                    keepGoing = true;
                }
            }
        }
        _currentIndexes.Add(_index);
    }
    public List<int> GetCurrentIndexes()
    {
        return _currentIndexes;
    }
    // public List<int> GetPreviousIndexes()
    // {
    //     return previousIndexes;
    // }
    // public void UpdatePreviousIndex()
    // {
    //     previousIndexes = currentIndexes;
    // }
}