import boto3
import base64
import json
import os

rekognition_client = boto3.client('rekognition')
file = open('man2.jpg','rb').read()

response = rekognition_client.detect_faces(
	Image = {
		'Bytes': file
	},
	Attributes = ['ALL']
)
for face in response['FaceDetails']:
	print('The detected candidate is '+ str(face['Gender']['Value']))
	print('The Age range of candidate is '+ str(face['AgeRange']['Low']) + '-'+ str(face['AgeRange']['High']) +' years old.')
	emotion_value = max(face['Emotions'], key=lambda ev: ev['Confidence'])
	print('The emotion of candidate is '+ str(emotion_value['Type']))
	

	if(str(face['Sunglasses']['Value']) == 'True'):
		print('The detected candidate is wearing Sunglasses')
	else:
		print('The detected candidate is not wearing Sunglasses')

	mustache = str(face['Mustache']['Value'])

	if mustache == 'True':
		print('The detected candidate has Mustache')
	else:
		print('The detected candidate does not have Mustache')

	mouth_open = str(face['MouthOpen']['Value'])

	if mouth_open == 'True':
		print('The detected candidate pic has mouth open')
	else:
		print('The detected candidate pic doesnot have mouth open')
	# print("Here are the Attributes")
	# print(json.dumps(face, indent = 4, sort_keys = True))