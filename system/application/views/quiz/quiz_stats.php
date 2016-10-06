{
  "title":{
    "text":  "Quiz Stats",
    "style": "{font-size: 20px; color:#0000ff; font-family: Verdana; text-align: center;}"
  },

  "y_legend":{
    "text": "Quiz Played",
    "style": "{color: #736AFF; font-size: 12px;}"
  },

  "elements":[
    {
      "type":      "bar",
      "alpha":     0.5,
      "colour":    "#9933CC",
      "text":      "",
      "font-size": 10,
      "values" :   [<?php echo $total_cat;?>]
    }
  ],

  "x_axis":{
    "stroke":1,
    "tick_height":10,
    "colour":"#d000d0",
    "grid_colour":"#00ff00",
    "labels": {
        "labels": [<?php echo $cat_names;?>]
    }
   },

  "y_axis":{
    "stroke":      4,
    "tick_length": 4,
    "colour":      "#d000d0",
    "grid_colour": "#00ff00",
    "offset":      0,
    "max":         <?=$max?>,
    "steps":       100
    
  }

}
