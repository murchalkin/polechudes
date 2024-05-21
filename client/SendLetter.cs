using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using TMPro;
using UnityEngine.UI;
using UnityEngine.Networking;

public class SendLetter : MonoBehaviour
{
    public GameObject inputfieldletter;
    public TextMeshProUGUI log;

    public void SendLetterr(){
       if(inputfieldletter.GetComponent<TMP_InputField>().text == "") return;
       StartCoroutine(Auther());
    }
    IEnumerator Auther(){
       UnityWebRequest request = UnityWebRequest.Get($"{Config.mainurl}/sendletter.php?id={Auth.myid}&letter={inputfieldletter.GetComponent<TMP_InputField>().text}");
       yield return request.SendWebRequest();
       log.text = request.downloadHandler.text;
       
    }
}

