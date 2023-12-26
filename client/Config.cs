using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Config : MonoBehaviour
{
     // Global
     public static string mainurl = ""; // main url https server
     public static string tokenauth = "vsiJrFivtbMlnxOH8FYBeQ=="; // hashed token for auth on server
     public static float keepalivetime = 0.5f; // keep alive time (seconds, allowed digits)
}
