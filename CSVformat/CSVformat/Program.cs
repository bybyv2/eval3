using System.Data;
using System.Diagnostics;
using System.Runtime.Serialization.Formatters;
using System.Security.Cryptography;
using System.Text;
using MySqlConnector;

int numeroLigne = 0;

string m_strMySQLConnectionString;
m_strMySQLConnectionString = "server=localhost;userid=root;password=123;database=indi";

using (var mysqlconnection = new MySqlConnection(m_strMySQLConnectionString))
{
    mysqlconnection.Open();
    bool premiereLigne = true;
    int i = 0;
    Random random = new Random();
    foreach (string line in System.IO.File.ReadAllLines(@"D:\Programmation\c#\CSVformat\csv\data.csv",
                 System.Text.Encoding.UTF8))
    {
        string image;
        var fix = line.Replace("'", "");
        fix = line.Replace("’", "");
        var columns = fix.Split(";");
        string idInformation = "'0'";
        string rating = columns[0];
        string compagnyName = "'"+columns[1] + "'";
        string jobTitle = "'" + columns[2] + "'";
        string salary =columns[3];
        string salariesReported = "'" + columns[4] + "'";
        string location = "'" + columns[5] + "'";
        //si job title contient droid.png
        jobTitle = jobTitle.Replace(" ", "-");
        numeroLigne = numeroLigne++;
        if (jobTitle.Contains("Android"))
        {
            image = "droid.png";
        }

        else if (jobTitle.Contains("Python"))
        {
            image = "python.png";
        }

        else if (jobTitle.Contains("IOS"))
        {
            image = "mac.png";
        }

        else if (jobTitle.Contains("SDE"))
        {
            image = "dev.png";
        }
        else
        {
            image = "empty.png";
        }

        image = "'" + image + "'";
        double salaryConvert;
        double salaryCHF = 0;
        Console.WriteLine(salary);
        Console.WriteLine(fix);
        if (salary != "")
        {
            salaryConvert = Convert.ToDouble(salary);
            salaryCHF = salaryConvert / 90.9090909090909;
        }

        double ratingDouble = Convert.ToDouble(rating);
        rating = "'" + rating + "'";
        salary = "'" + salary + "'";
        if (ratingDouble > 3.0)
        {
            string sql =
                $"INSERT INTO t_informations(idInformation, rating, compagnyName, jobTitle, salary, salariesRepored, location, image, salaryCHF) VALUES ({idInformation + "," + rating + "," + compagnyName + "," + jobTitle + "," + salary + "," + salariesReported + "," + location + "," + image + "," + "'" + salaryCHF + "'"})";
            using (MySqlCommand cmd = mysqlconnection.CreateCommand())
            {
                cmd.CommandType = CommandType.Text;
                cmd.CommandTimeout = 300;
                cmd.CommandText = sql;
                try
                {
                    i += cmd.ExecuteNonQuery();
                }
                catch (Exception e)
                {
                    Console.WriteLine(sql + "\n" + e.Message);
                }
            }
        }
    }

    Console.WriteLine($"{i} lignes ajoutees");
    premiereLigne = false;
    mysqlconnection.Close();
}