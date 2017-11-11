package com.webservice.example;
 
import android.app.Activity;
import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
 
import org.json.JSONException;
import org.json.JSONObject;
 
import java.util.HashMap;
 
public class MainActivity extends Activity {
    //texto
    private EditText etCorreo;
    private EditText etContrasena;
    //botones
    private Button btnEnviar;
    private ProgressDialog pDialog;
    //parseo
    private JSONObject json;
    private int success=0;
    //coneccion
    private HTTPURLConnection service;
    //Strings
    private String strCorreo ="", strContrasena ="";
    //Initialize webservice URL
    private String path = "http://sweetdev.net/agregar_usuario.php";
 
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
 
        etCorreo= (EditText) findViewById(R.id.etCorreo);
        etContrasena= (EditText) findViewById(R.id.etContrasena);
        btnEnviar= (Button) findViewById(R.id.btnEnviar);
 
        //Initialize HTTPURLConnection class object
        service=new HTTPURLConnection();
 
        btnEnviar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (!etCorreo.getText().toString().equals("") && !etContrasena.getText().toString().equals("")) {
                    strCorreo = etCorreo.getText().toString();
                    strContrasena = etContrasena.getText().toString();
                    //Call WebService
                    new PostDataTOServer().execute();
                } else {
                    Toast.makeText(getApplicationContext(), "¡Ingrese todos los datos!", Toast.LENGTH_LONG).show();
                }
            }
        });
    }
 
    private class PostDataTOServer extends AsyncTask<Void, Void, Void> {
 
        String response = "";
        //Se crea un hash map para mandar los paramatros al web sevice
        HashMap<String, String> postDataParams;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
 
            pDialog = new ProgressDialog(MainActivity.this);
            pDialog.setMessage("Cargando...");
            pDialog.setCancelable(false);
            pDialog.show();
        }
        @Override
        protected Void doInBackground(Void... arg0) {
            postDataParams=new HashMap<String, String>();
            postDataParams.put("Correo", strCorreo);
            postDataParams.put("Contrasena", strContrasena);
            //Call ServerData() method to call webservice and store result in response
            response= service.ServerData(path,postDataParams);
            try {
                     json = new JSONObject(response);
                    //Get Values from JSONobject
                    System.out.println("success=" + json.get("success"));
                    success = json.getInt("success");
 
            } catch (JSONException e) {
                e.printStackTrace();
            }
            return null;
        }
        @Override
        protected void onPostExecute(Void result) {
            super.onPostExecute(result);
            if (pDialog.isShowing())
                pDialog.dismiss();
            if(success==1) {
                Toast.makeText(getApplicationContext(), "¡Se registro exitosamente..!", Toast.LENGTH_LONG).show();
            }
        }
    }
}