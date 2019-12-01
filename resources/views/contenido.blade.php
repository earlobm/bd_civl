@extends('principal')
    @section('contenido')
        <template v-if="menu==0">
        <dashboardmain  ></dashboardmain>
        </template>
        <!-- SISTEMA DE PRESTAMOS -->
        <template v-if="menu==13">
        <customercredit></customercredit>
        </template>
        <!-- SISTEMA DE EMPEÑOS -->
        <!-- REGISTERS -->
        <template v-if="menu==1">
        <customerpledge ></customerpledge>
        </template>
        
        <template v-if="menu==11">
        <payment ></payment>
        </template>
        <template v-if="menu==18">
        <profile ></profile>
        </template>
        <template v-if="menu==19">
        <market></market>
        </template>
        <template v-if="menu==20">
        <detailpledge></detailpledge>
        </template>
        <template v-if="menu==21">
        <contrato></contrato>
        </template>
        <template v-if="menu==22">
        <montodia></montodia>
        </template>
        <template v-if="menu==24">
        <document></document>
        </template>
        <template v-if="menu==23">
        <business></business>
        </template>
        <template v-if="menu==25">
        <resumendia></resumendia>
        </template>
        <template v-if="menu==15">
        <branchoffice></branchoffice>
        </template>

        <template v-if="menu==2">
        <staff ></staff>
        </template>
        <template v-if="menu==3">
        <actividad ></actividad>
        </template>
        <template v-if="menu==4">
        <unidad ></unidad>
        </template>
        <template v-if="menu==5">
        <fuentesfinanciera ></fuentesfinanciera>
        </template>
        <template v-if="menu==6">
        <clasificador ></clasificador>
        </template>
        <template v-if="menu==7">
        <income ></income>
        </template>
        <template v-if="menu==9">
        <egress ></egress>
        </template>
      
     
        <template v-if="menu==10">
        <carhregister ></carhregister>
        </template>
        
        
        <template v-if="menu==12">
        <garmenttype ></garmenttype>
        </template>
        
       <!--plan operativo -->
        <template v-if="menu==14">
        <reference ></reference>
        </template>


        <!--security -->
        <template v-if="menu==16">
            <user></user>
        </template>
        <template v-if="menu==17">
            <role></role>
        </template>
        <!--cobranza diaria credito-->
        <template v-if="menu==100">
            <dailycollection></dailycollection>
        </template>
        

        
    @endsection