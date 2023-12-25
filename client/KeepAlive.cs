using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;
using UnityEngine.SceneManagement;

public class KeepAlive : MonoBehaviour
{
    public GameObject buttonletter;
    public GameObject againbutton;
    public Text word;
    public Text log;
    private float timer;
    void Start(){
    againbutton.SetActive(false);
    timer = Config.keepalivetime; 
   }
    // Start is called before the first frame update
    void Update()
    {
        if(word.text != ""){
           buttonletter.SetActive(true);
        }else{
        buttonletter.SetActive(false);
        }
        if(timer <= 0f){
        if(Auth.myid != "" && Auth.myid != null){
        StartCoroutine(Auther());
       }
        timer = Config.keepalivetime;
        }else{
         timer -= Time.deltaTime;
       }
    }
    IEnumerator Auther(){
       UnityWebRequest request = UnityWebRequest.Get($"{Config.mainurl}/keepalive.php?id={Auth.myid}");
       yield return request.SendWebRequest();
       if(request.downloadHandler.text != "Вы не авторизованы" && request.downloadHandler.text != "Игра не начата"){
          try{
          int.Parse(request.downloadHandler.text);
          }catch{
          word.text = request.downloadHandler.text;
          yield break;
          }
          word.text = "Выиграл игрок с айди: " + request.downloadHandler.text;
          againbutton.SetActive(true);
       }else{
       if(request.downloadHandler.text == "Игра не начата"){
        log.text = "Ожидание игроков";
     }
          print(request.downloadHandler.text);
       } 
       
    }
    public void Againn(){
       Auth.myid = "";
       SceneManager.LoadScene("SampleScene", LoadSceneMode.Single);
    }
}
