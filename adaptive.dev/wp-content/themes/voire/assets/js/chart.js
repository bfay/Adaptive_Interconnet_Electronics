/* ========================================================================
 * Omega: chart.js
 * Loads charts for corporate page
 * ========================================================================
 * Copyright 2014 Oxygenna LTD
 * ======================================================================== */

'use strict';

// ignore camel case because it breaks jshint for vars from php localisation
/* jshint camelcase: false */

/* global jQuery: false, Chart: false */

jQuery(document).ready(function( $ ) {

    // pie chart
    var chart_144Ops = {
        animation: true
    };
    var chart_144Data = [{
        value   : 10,
        color   : '#ff9564'
    },{
        value   : 32,
        color   : '#ffbf5a'
    },{
        value   : 50,
        color   : '#c4df9a'
    },{
        value   : 25,
        color   : '#afe8f3'
    },{
        value   : 5,
        color   : '#83c1f1'
    }];
    var wpChartchart_144Pie = new Chart(document.getElementById('chart_144').getContext('2d')).Pie(chart_144Data,chart_144Ops);

    // bar chart
    var barchartOps = {
        animation: true,
        scaleFontSize: 16,
        scaleFontColor: '#666',
        scaleOverride:true,
        scaleSteps:8,
        scaleStepWidth:10,
        scaleStartValue:0
    };
    var barchartData = {
        labels : ['iphone','ipad','android','other'],
        datasets : [{
            fillColor   : 'rgba(233,233,233,0.7)',
            strokeColor : 'rgba(233,233,233,1)',
            data        : [40,32,50,35]
        },{
            fillColor   : 'rgba(182,184,187,0.7)',
            strokeColor : 'rgba(182,184,187,1)',
            data        : [20,25,45,42]
        },{
            fillColor   : 'rgba(131,200,236,0.7)',
            strokeColor : 'rgba(131,200,236,1)',
            data        : [40,43,61,50]
        },{
            fillColor   : 'rgba(147,151,155,0.7)',
            strokeColor : 'rgba(147,151,155,1)',
            data        : [33,15,40,22]
        }]
    };
    var wpChartbarchartBar = new Chart(document.getElementById('barchart').getContext('2d')).Bar(barchartData,barchartOps);

    // line chart
    var chart_400Ops = {
        animation: true,
        scaleFontSize: 14,
        scaleFontColor: '#666666',
        scaleOverride:true,
        scaleSteps:9,
        scaleStepWidth:10,
        scaleStartValue:0
    };
    var chart_400Data = {
        labels : ['2007','2008','2009','2010','2011','2012','2013'],
        datasets : [{
            fillColor   : 'rgba(131,194,245,0.7)',
            strokeColor : 'rgba(131,194,245,1)',
            pointColor  : 'rgba(131,194,245,1)',
            pointStrokeColor : '#FFFFFF',
            data        : [18,33,51,60,75,58,80]
        },{
        fillColor   : 'rgba(209,210,212,0.7)',
        strokeColor : 'rgba(209,210,212,1)',
        pointColor  : 'rgba(209,210,212,1)',
        pointStrokeColor : '#FFFFFF',
        data        : [33,15,40,32,38,57,46]
        }]
    };
    var wpChartchart_400Line = new Chart(document.getElementById('chart_400').getContext('2d')).Line(chart_400Data,chart_400Ops);
});