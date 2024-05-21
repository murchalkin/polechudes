using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using TMPro;
using UnityEngine.UI;
using UnityEngine.Networking;
using UnityEngine.SceneManagement;

public class KeepAlive : MonoBehaviour
{
    public GameObject buttonletter;
    public GameObject againbutton;
    public TextMeshProUGUI word;
    public TextMeshProUGUI log;
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
          if(log.text == "Ожидание игроков..."){
          log.text = "";
         }
          try{
          int.Parse(request.downloadHandler.text);
          }catch{
          word.text = request.downloadHandler.text;
          yield break;
          }
          word.text = "Выиграл игрок с ID: " + request.downloadHandler.text;
          againbutton.SetActive(true);
       }else{
     if(request.downloadHandler.text == "Вы не авторизованы"){
       log.text = "Вы были кикнуты";
       buttonletter.SetActive(false);
       againbutton.SetActive(true);
       word.text = "";
       Auth.myid = "";
      }
          print(request.downloadHandler.text);
       } 
       
    }
    public void Againn(){
       Auth.myid = "";
       SceneManager.LoadScene("SampleScene", LoadSceneMode.Single);
    }
}
