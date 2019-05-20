import re
import sys

# ftr = File To Read
# ftw = File To Write

PUBLIC_FILES = ['css', 'fonts', 'images', 'js']
regex1 = r"url\((?P<path>.*/images/.*?)\)"
regex2 = r"src=\"(?P<path>.*/images/.*?)\"" 

file_path = sys.argv[1].split("/")[:-1]
file_path = "/".join(file_path)

file_name = sys.argv[1].split("/")[-1]

ftr = open(file_path + "/" + file_name, "r")
ftw = open(file_path + "/m_" + file_name, "w")

for line in ftr.readlines():
    if re.search(regex1, line):
        string = re.search(regex1, line)
        img_name = string.string.split("/")[-1].split(")")[0]
        new_source = "{{ asset('images/" + img_name + "') }}"
        ftw.write(line.replace(string.group('path'), new_source))
    elif re.search(regex2, line):
        string = re.search(regex2, line)
        img_name = string.string.split("/")[-1].split("\"")[0]
        new_source = "{{ asset('images/" + img_name + "') }}"
        ftw.write(line.replace(string.group('path'), new_source))
    else:
        pass
        ftw.write(line)


