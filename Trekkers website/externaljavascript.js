/* 
 This script provide a document write function of a quote.
 */

// Example 26-14: javascript.js

canvas               = O('logo')
context              = canvas.getContext('2d')
context.font         = 'bold italic 97px Time New Roman'
context.textBaseline = 'top'
image                = new Image()
image.src            = 'mountaineer.gif'

image.onload = function()
{
  gradient = context.createLinearGradient(0, 0, 0, 89)
  gradient.addColorStop(0.00, '#0E8')
  gradient.addColorStop(0.66, '#0F3')
  context.fillStyle = gradient
  context.fillText(  "Trek Mo   ntain", 0, 0)
  context.strokeText("Trek Mo   ntain", 0, 0)
  context.drawImage(image, 340, 42)
}

function O(i) { return typeof i == 'object' ? i : document.getElementById(i) }
function S(i) { return O(i).style                                            }
function C(i) { return document.getElementsByClassName(i)                    }
