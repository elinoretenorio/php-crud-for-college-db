curl -X GET "localhost:8080/colleges"

curl -X POST "localhost:8080/colleges" -H 'Content-Type: application/json' -d'
{
  "college_name": "hope",
  "college_total_students": 1679
}
'

curl -X POST "localhost:8080/colleges/3793" -H 'Content-Type: application/json' -d'
{
  "college_id": 3793,
  "college_name": "hope",
  "college_total_students": 1679
}
'

curl -X GET "localhost:8080/colleges/3793"

curl -X DELETE "localhost:8080/colleges/3793"

# --

curl -X GET "localhost:8080/buildings"

curl -X POST "localhost:8080/buildings" -H 'Content-Type: application/json' -d'
{
  "building_name": "play",
  "college_name": "tend"
}
'

curl -X POST "localhost:8080/buildings/587" -H 'Content-Type: application/json' -d'
{
  "building_id": 587,
  "building_name": "play",
  "college_name": "tend"
}
'

curl -X GET "localhost:8080/buildings/587"

curl -X DELETE "localhost:8080/buildings/587"

# --

curl -X GET "localhost:8080/classrooms"

curl -X POST "localhost:8080/classrooms" -H 'Content-Type: application/json' -d'
{
  "building_id": 9776,
  "has_projector": true,
  "room_number": 7553
}
'

curl -X POST "localhost:8080/classrooms/6517" -H 'Content-Type: application/json' -d'
{
  "building_id": 9776,
  "classroom_id": 6517,
  "has_projector": true,
  "room_number": 7553
}
'

curl -X GET "localhost:8080/classrooms/6517"

curl -X DELETE "localhost:8080/classrooms/6517"

# --

curl -X GET "localhost:8080/textbooks"

curl -X POST "localhost:8080/textbooks" -H 'Content-Type: application/json' -d'
{
  "textbook_author": "girl",
  "textbook_isbn": 9623,
  "textbook_title": "cup"
}
'

curl -X POST "localhost:8080/textbooks/4464" -H 'Content-Type: application/json' -d'
{
  "textbook_author": "girl",
  "textbook_id": 4464,
  "textbook_isbn": 9623,
  "textbook_title": "cup"
}
'

curl -X GET "localhost:8080/textbooks/4464"

curl -X DELETE "localhost:8080/textbooks/4464"

# --

curl -X GET "localhost:8080/courses"

curl -X POST "localhost:8080/courses" -H 'Content-Type: application/json' -d'
{
  "course_name": "audience",
  "textbook_isbn": 4266
}
'

curl -X POST "localhost:8080/courses/4833" -H 'Content-Type: application/json' -d'
{
  "course_id": 4833,
  "course_name": "audience",
  "textbook_isbn": 4266
}
'

curl -X GET "localhost:8080/courses/4833"

curl -X DELETE "localhost:8080/courses/4833"

# --

curl -X GET "localhost:8080/persons"

curl -X POST "localhost:8080/persons" -H 'Content-Type: application/json' -d'
{
  "person_name": "foreign",
  "person_phone_number": "strong"
}
'

curl -X POST "localhost:8080/persons/6202" -H 'Content-Type: application/json' -d'
{
  "person_id": 6202,
  "person_name": "foreign",
  "person_phone_number": "strong"
}
'

curl -X GET "localhost:8080/persons/6202"

curl -X DELETE "localhost:8080/persons/6202"

# --

curl -X GET "localhost:8080/faculties"

curl -X POST "localhost:8080/faculties" -H 'Content-Type: application/json' -d'
{
  "faculty_name": "media",
  "faculty_salary": 827.0,
  "person_id": 1696
}
'

curl -X POST "localhost:8080/faculties/4740" -H 'Content-Type: application/json' -d'
{
  "faculty_id": 4740,
  "faculty_name": "media",
  "faculty_salary": 827.0,
  "person_id": 1696
}
'

curl -X GET "localhost:8080/faculties/4740"

curl -X DELETE "localhost:8080/faculties/4740"

# --

curl -X GET "localhost:8080/interns"

curl -X POST "localhost:8080/interns" -H 'Content-Type: application/json' -d'
{
  "intern_hourly_wage": 985.1195,
  "person_id": 7614
}
'

curl -X POST "localhost:8080/interns/5418" -H 'Content-Type: application/json' -d'
{
  "intern_hourly_wage": 985.1195,
  "intern_id": 5418,
  "person_id": 7614
}
'

curl -X GET "localhost:8080/interns/5418"

curl -X DELETE "localhost:8080/interns/5418"

# --

curl -X GET "localhost:8080/sections"

curl -X POST "localhost:8080/sections" -H 'Content-Type: application/json' -d'
{
  "building_id": 8599,
  "course_id": 1634,
  "person_id": 9735,
  "room_number": 2847,
  "section_date": "2021-09-25"
}
'

curl -X POST "localhost:8080/sections/1619" -H 'Content-Type: application/json' -d'
{
  "building_id": 8599,
  "course_id": 1634,
  "person_id": 9735,
  "room_number": 2847,
  "section_date": "2021-09-25",
  "section_id": 1619
}
'

curl -X GET "localhost:8080/sections/1619"

curl -X DELETE "localhost:8080/sections/1619"

# --

curl -X GET "localhost:8080/students"

curl -X POST "localhost:8080/students" -H 'Content-Type: application/json' -d'
{
  "person_id": 1096,
  "student_gpa": 975.9,
  "student_name": "owner"
}
'

curl -X POST "localhost:8080/students/1446" -H 'Content-Type: application/json' -d'
{
  "person_id": 1096,
  "student_gpa": 975.9,
  "student_id": 1446,
  "student_name": "owner"
}
'

curl -X GET "localhost:8080/students/1446"

curl -X DELETE "localhost:8080/students/1446"

# --

