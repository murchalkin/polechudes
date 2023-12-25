using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;

public class SendLetter : MonoBehaviour
{
    public InputField inputfieldletter;
    public Text log;

    public void SendLetterr(){
       StartCoroutine(Auther());
    }
    IEnumerator Auther(){
       UnityWebRequest request = UnityWebRequest.Get($"{Config.mainurl}/sendletter.php?id={Auth.myid}&letter={inputfieldletter.text}");
       yield return request.SendWebRequest();
       log.text = request.downloadHandler.text;
       
    }
}
