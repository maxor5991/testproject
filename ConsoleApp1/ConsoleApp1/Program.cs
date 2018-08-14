using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ConsoleApp1
{
    class Program
    {
        static void Main(string[] args)
        {
            string hiddenWord = Console.ReadLine();
            string shownWord = "";

            Console.Clear();
            //if (hiddenWord == "hola") {
            //    Console.WriteLine("chau");
            //}
            //else if(hiddenWord== "chau"){
            //    Console.WriteLine("Rayos me haz derrotado");

            //}
            //else
            //{
            //    Console.WriteLine("Tendrias que haberme saludado...");
            //}
            for (int i=0; i <hiddenWord.Length; i++)
            {
                Console.WriteLine (shownWord);
            }
        }
    }
}
