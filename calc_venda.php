<script>
    //Fonte: https://forum.imasters.com.br/topic/410822-resolvido%C2%A0porcentagem/
    //Post:Ariane Stela
    //Adptações: André de Castro / 2019
    function moeda2float(moeda)
	{        
		//retirar os pontos        
		moeda = moeda.replace(".","");        
		//mudar a virgula pelo ponto        
		moeda = moeda.replace(",",".");        
		//retornar em formato float        
		return parseFloat(moeda);
	}
	
	function float2moeda(num) 
	{        
		x = 0;        
	if(num<0)
		{                
			num = Math.abs(num);            
			x = 1;        
		}        
	if(isNaN(num))                 
		num = "0";            
		cents = Math.floor((num*100+0.5)%100);    
		num = Math.floor((num*100+0.5)/100).toString();    
	if(cents < 10)         
		cents = "0" + cents;        
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)       
		num = num.substring(0,num.length-(4*i+3))+'.'+num.substring(num.length-(4*i+3));        
		ret = num + ',' + cents;        
	if (x == 1)        
		ret = ' - ' + ret;        
	return ret;
	}	
	
	/*calculo
         * #totalvenda
         * + #valor_entrega
         * - #desconto
         * = #valor_apagar
         * - #dinheiro
         * = #troco
         * 
         */
        
	function calcular() 
	{        
		//calcular valor da entrega e da desconto
                var valor_apagar = 0;                        
		//recuperar o valor e transforma-lo em float        
		var totalvenda = $('#totalvenda').val();        
		totalvenda = moeda2float(totalvenda);
                var valor_entrega = $('#valor_entrega').val();        
		valor_entrega = moeda2float(valor_entrega); 
		//recuperar o valor e transforma-lo em porcentagem        
		var desconto = $('#desconto').val();
                var valor_apagar = $('#valor_apagar').val();        
		valor_apagar = moeda2float(valor_apagar);                         
		//faz o calculo         
		valor_apagar = totalvenda + valor_entrega - desconto;                    
		//retornar o total em formato de moeda        
		return float2moeda(valor_apagar);
            }
        function troco(){        
                //calcular o troco
                var troco = 0;                        
		//recuperar o valor e transforma-lo em float
                var valor_apagar = $('#valor_apagar').val();        
		valor_apagar = moeda2float(valor_apagar);       
		var dinheiro = $('#dinheiro').val(); 
		//faz o calculo         
		troco = dinheiro - valor_apagar;                    
		//retornar o total em formato de moeda        
		return float2moeda(troco);
	}     
		
		
$(document).ready(function()
{        
//bind do input desconto        
 $("input[name='desconto']").keypress(function(){              
 $("#valor_apagar").val(calcular());    }); 
 $("input[name='desconto']").keyup(function(){                
 $("#valor_apagar").val(calcular());    }); 
 $("input[name='desconto']").keydown(function(){                
 $("#valor_apagar").val(calcular());    });            
 
 //bind do input totalvenda        
 $("input[name='totalvenda']").keypress(function(){                
 $("#valor_apagar").val(calcular());    }); 
 $("input[name='totalvenda']").keyup(function(){                
 $("#valor_apagar").val(calcular());    }); 
 $("input[name='totalvenda']").keydown(function(){                
 $("#valor_apagar").val(calcular());  });
 //calcular troco
 //bind do input desconto        
 $("input[name='dinheiro']").keypress(function(){              
 $("#troco").val(troco());    }); 
 $("input[name='dinheiro']").keyup(function(){                
 $("#troco").val(troco());    }); 
 $("input[name='dinheiro']").keydown(function(){                
 $("#troco").val(troco());    });  
});	
	
	
	
    </script>
 <form action="" method="post" enctype="multipart/form-data">
<div class="input-group input-group">
<span class="input-group-addon">Total venda: </span>
<input type="text" class="form-control" name="totalvenda" autocomplete="off" id="totalvenda" value="<?php echo $vSubTotal;?>">
</div>
<div class="input-group input-group">
<span class="input-group-addon">Valor Entrega:</span>
<input type="text" name="valor_entrega" id="valor_entrega" autocomplete="off" class="form-control" value="<?php echo $valor_entrega;?>" /><p>
</div>   
<div class="input-group input-group">
<span class="input-group-addon"><b><font color="red">Desconto(R$):</b></font></span>                            
<input type="text" class="form-control " name="desconto" autocomplete="off" id="desconto" value="<?php echo $desconto;?>" title="Informe o desconto">
</div>
<div class="input-group input-group">
<span class="input-group-addon"><b>Total A pagar:</b></span>                                
<input type="text" class="form-control" name="valor_apagar" id="valor_apagar" autocomplete="off"  value="<?php echo $vSubTotal+$valor_entrega;?>" >
</div>
<div class="input-group input-group">
    <span class="input-group-addon"><b><font color="blue">Dinheiro:</b></font></span>
    <input type="text" name="dinheiro" id="dinheiro" autocomplete="off" class="form-control" title="Informe o dinheiro do cliente"  value="<?php echo $dinheiro;?>" />
</div>     
<div class="input-group input-group">
    <span class="input-group-addon"><b>Seu Troco:</b></span>
    <input type="text" name="troco" class="form-control" id="troco" value="<?php echo $troco;?>"/>
</div><br>

