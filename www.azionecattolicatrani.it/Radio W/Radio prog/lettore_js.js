var sendto='mailto:insertemail@inhypertextproperties.please';
var faxto=';';
var colpari='#80F0FF';
var coldisp='#80E0FF';
var ismail=true;
var rmk='';
//questi li mette il programma
//var sendto='mailto:youraddress@yourprovider.com'
//var faxto='02-12345678'
//var colpari='#fff080'
//var coldisp='#ffe080'
//var ismail=true

//non toccare quanto segue, se non sei un esperto
var mostraIVA=false
var showtotal=true
var showpartial=true

//immediately show the cart
//creaCarrello()
//datiCarrello=parent.finestraCarrello.carrello

//create cart popup
function creaCarrello()
{
 if(!parent.finestraCarrello||parent.finestraCarrello.closed)
 {
  tmpcarr=open("","ilcarrello")
  if ( (tmpcarr.carrello == null) || (!tmpcarr.carrello) )
  {
   tmpcarr.close( )
   parent.finestraCarrello=open("about:blank","ilcarrello",
     "toolbar=no,width=560,height=400")
   parent.finestraCarrello.document.write('<HTML><HEAD>'
+'<TITLE>Carrello della spesa - shopping cart</TITLE></HEAD><frameset rows="100%,*"><frame name=hidden src="about:blank" noresize frameborder=no><frame name=main src="about:blank" frameborder=no></frameset></HTML>')
   parent.finestraCarrello.document.close()

   var srcFramesCar="<HTML><HEAD><TITLE>Cart<\/TITLE><script>var carrello={}<\/script><HEAD><BODY><\/BODY><\/HTML>"
   
   for(i=0;i<=1;i++)
   with(parent.finestraCarrello.frames[i].document)
   {
   write(srcFramesCar)
   close()
   }
   parent.finestraCarrello.carrello={}
  }
  else
  {
   parent.finestraCarrello=tmpcarr
   datiCarrello=tmpcarr.carrello
  }
 }
}
        
        
//show cart
function MyAddCart(codice, prezzoUnitario, desc)
{
  creaCarrello()
  datiCarrello=parent.finestraCarrello.carrello
  if(!datiCarrello[codice]) datiCarrello[codice]={quantita:1,prezzoUnitario:parseFloat(prezzoUnitario),descr:desc}
  else datiCarrello[codice].quantita++
}
        
        
//show cart
function MyShowCart(codice, prezzoUnitario, simbolo, colorerigapari, colorerigadispari)
{
  var newWin=parent.finestraCarrello.hidden
  var sortedAry=[]
  for(itemCode in datiCarrello) sortedAry[sortedAry.length]=String(itemCode).toLowerCase()
  sortedAry.sort()
  with(newWin.document)
  {
    write("<html><head><script>"
      +"function update(objValue,itemCode){parent.carrello[itemCode].quantita=objValue.replace(/\\D/g,'');setTimeout('parent.opener.MyShowCart(1,1,\""+simbolo+"\",\""+colorerigapari+"\",\""+colorerigadispari+"\")',0)}"
      +"<\/script><\/head><body><form method='post' action='"
      +sendto+"'")
    if (ismail) write(" enctype='text/plain' ")
    write("><table width=95% border='0' cellspacing='0' ><th>Scontrino</th>"
      +"<tr><td>N.</td><td>Quantità</td><td>Prezzo unit.</td>"
      +"<td>Codice</td><td>Descr.</td>")
    if (showpartial) write("<td>Totale parz.</td>");
    write("</tr>");
                                for(counter=totale=parziale=0;counter<sortedAry.length;counter++,totale+=parziale)
    {
      itemCode=sortedAry[counter]
parziale=datiCarrello[itemCode].quantita*datiCarrello[itemCode].prezzoUnitario
      unit=datiCarrello[itemCode].prezzoUnitario;
      descc=datiCarrello[itemCode].descr;
      write("<tr bgcolor='"
        +[colorerigadispari,colorerigapari][counter&1]+"'>\n"
        +"<td>"+(counter+1)+".</td>\n<td>\n" 
        +"<input type=hidden name='it_"+itemCode
        +"' value="+counter+">\n"
        +"<input name='itq_"+itemCode+"' size=5 value="                
        +datiCarrello[itemCode].quantita+" onchange='update(this.value,\""+itemCode+"\")'>\n"
        +"<input type=hidden name='itu_"+itemCode
        +"' value='"+unit+"'>\n"
        +"<input type=hidden name='itd_"+itemCode
        +"' value='"+descc+"'>\n"
        +"</td>\n"
        +"<td>"+simbolo+" "+unit+"</td>\n"
        +"<td>"+itemCode+"</td>\n"
        +"<td>"+descc+"</td>\n")
      if (showpartial)
      write("<td>"+simbolo
        +" "+(Math.round(parziale*100)/100)+"</td>\n")
      write("</tr>\n\n")
    }
    if (showtotal)
        write("<tr><td colspan=3>Totale:</td><td>"+simbolo+" "
        +Math.round(totale*100)/100+"</td><td>"
        +"<input type=button value='Aggiorna' ></td></tr>")
        else
        write("<tr><td colspan=5><input type=button value='Aggiorna' ></td></tr>")
    if(mostraIVA)
        write("<tr><td colspan=3>Totale (IVA incl.):</td><td>"
          +simbolo+" "+(Math.round(totale*120)/100)+"</td></tr>")
    write("</table><br>"
        +"Nome: <input name='name' ><br>"
        +"Indirizzo: <input name=address ><br>"
        +"Email: <input name=email ><br>"
        +"Telefono: <input name=phone ><br>"
        +"Commenti: <input name=remarks ><br>")

    write("<br>"+rmk+"<br>"
        +"<textarea name=remarks2 rows=10 cols=35 ></textarea><br>"
        )
    if (faxto)
        write(
              "Stampa il modulo ed invialo via fax al numero "
              +faxto
              +", oppure premi Invia per inviarlo via Internet.<br>")
        else
        write(
              "Premi Invia per inviare il modulo.<br>")
    write(
        "<input type=submit value='Invia'> "
        +"<input type=button value='Stampa' onClick='javascript:print()' ><br><br> "
        +"Chiudi la finestra oppure premi Azzera per svuotare il carrello.<br>"
        +"<input type=button value='Azzera' onClick='javascript:parent.close()' >"
        +"<\/form><\/body><\/html>")
    close()
  }
  parent.finestraCarrello.focus()
}
        
function MyAddAndShowCart(cod, prezzoUnit, simb, desc, colp, cold)
{
  MyAddCart(cod,prezzoUnit,desc)
  MyShowCart(cod,prezzoUnit,simb,colp,cold)
}

function MyFocusCart()
{
  tmpcarr=open("","ilcarrello")
  tmpcarr.focus()
}                                                                                                                                            
