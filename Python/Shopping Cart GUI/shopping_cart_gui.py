import tkinter as tk
from tkinter import Frame, Label, Button, ACTIVE, END, Entry, StringVar, IntVar, DoubleVar, Listbox, SINGLE, E, W
from number_entry import IntEntry

ITEM = 0
QUANTITY = 1
COST = 2

def main():
    root = tk.Tk()
    window = Frame(root)
    window.master.title('Shopping List')
    window.pack(padx=4, pady=3, fill=tk.BOTH, expand=1)

    theList = Listbox(window, selectmode=SINGLE)
    theList.grid(row=0,column=0,columnspan=3,sticky=E)

    populate_main_window(window, theList)

    root.mainloop()

def populate_main_window(window, theList):

    item=StringVar()
    quantity=IntVar()
    cost=DoubleVar()
    tax_percent=DoubleVar()

    quantity.set(1)
    tax_percent.set(10)

    shopping = []


    Label(window, text='Item:').grid(row=1, column=0,sticky=E)
    Entry(window, textvariable=item).grid(row=1, column=1,sticky=W)

    Label(window, text='Quantity:').grid(row=2, column=0, sticky=E)
    IntEntry(window, textvariable=quantity,lower_bound=1).grid(row=2,column=1, sticky=W)

    Label(window, text='Cost:').grid(row=3, column=0, sticky=E)
    IntEntry(window, textvariable=cost,lower_bound=0).grid(row=3,column=1, sticky=W)

    Label(window, text='Tax:').grid(row=4, column=0, sticky=E)
    IntEntry(window, textvariable=tax_percent, lower_bound=1).grid(row=4, column=1, sticky=W)

    Label(window, text='Total:').grid(row=5, column=0, sticky=E)
    lbl_total = Label(window, width=6)
    lbl_total.grid(row=5,column=1, sticky=W)


    def create_list_box(shopping):
        for elem in shopping:
            theList.insert(END,elem[ITEM] + ' - ' + str(elem(QUANTITY)) + ' - ' + str(f'${elem[COST]:.2f}'))
            
    create_list_box(shopping)


    def listIndex(shopping, item):
        index = -1
        for i in range(len(shopping)):
            if shopping[i][ITEM] == item:
                index = i
        return index

    def addList(shopping, item, index):
        if index == -1:
            shopping.append((item,quantity.get(),cost.get()))
        else:
            shopping[index][QUANTITY] += quantity.get()
            shopping[index][COST] += cost.get()

    def removeList(shopping, index):
        del(shopping[index])

    def add():
        index = listIndex(shopping, item.get())
        addList(shopping, item.get(), index)
        if index >= 0:
            theList.delete(index)
            theList.insert(index, shopping[index][0] + '-' + str(shopping[index][1]) + '-' + str(shopping[index][2]))
        else:
            theList.insert(END, item.get() + ' - ' + str(quantity.get()) + ' - ' + str(f'${quantity.get() * cost.get():.2f}'))

    def remove():
        index = theList.index(ACTIVE)
        print(f'Removed: {shopping[index][ITEM]}')
        removeList(shopping, index)
        theList.delete(index)

    def sumtotal():
        sumtotal = 0
        for i in range(len(shopping)):
            sumtotal += (shopping[i][COST] * shopping[i][QUANTITY])
        lbl_total.config(text=f'${(sumtotal + tax_percent.get()/100 * sumtotal):.2f}')
        


    add_button = Button(window, text='Add', command= lambda: [add(), sumtotal()])
    add_button.grid(row=4,column=3,columnspan=3)

    remove_button = Button(window, text='Remove', command= lambda: [remove(), sumtotal()])
    remove_button.grid(row=0,column=3)



if __name__ == '__main__':
    main()