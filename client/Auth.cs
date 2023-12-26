using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;

public class Auth : MonoBehaviour
{
    public static string myid;
    public Text log;
    // Start is called before the first frame update
    void Start()
    {
        StartCoroutine(Auther());
    }
    IEnumerator Auther(){
       UnityWebRequest request = UnityWebRequest.Get($"{Config.mainurl}/auth.php?token={Config.tokenauth}");
       yield return request.SendWebRequest();
       if(request.downloadHandler.text != "Ошибка авторизации" && request.downloadHandler.text != "Сервер переполнен" && request.downloadHandler.text != "Ошибка сервера"){
         myid = request.downloadHandler.text;
         print($"Received generated id client: {myid}");
       }else{
          log.text = request.downloadHandler.text;
       }
       
    }
}
