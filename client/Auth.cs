using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using TMPro;
using UnityEngine.Networking;

public class Auth : MonoBehaviour
{
    public static string myid;
    public GameObject againbutton;
    public TextMeshProUGUI log;
    // Start is called before the first frame update
    void Start()
    {
         log.text = "Подключение к серверу...";
        StartCoroutine(Auther());
    }
    IEnumerator Auther(){
       UnityWebRequest request = UnityWebRequest.Get($"{Config.mainurl}/auth.php?token={Config.tokenauth}");
       yield return request.SendWebRequest();
       if(request.downloadHandler.text != "Ошибка авторизации" && request.downloadHandler.text != "Сервер переполнен" && request.downloadHandler.text != "Ошибка настройки сервера"){
        try{
        int.Parse(request.downloadHandler.text);
       }
       catch{
        log.text = "На сервере произошел сбой";
        againbutton.SetActive(true);
        print("Server error");
       yield break;
       }
         log.text = "Ожидание игроков...";
         myid = request.downloadHandler.text;
         print($"Received generated id client: {myid}");
       }else{
          againbutton.SetActive(true);
          log.text = request.downloadHandler.text;
          yield break;
       }
    }
}
