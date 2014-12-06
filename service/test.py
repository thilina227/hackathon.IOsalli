#!/usr/bin/python2.7
import cgi
import requests
from xml.parsers.expat import ParserCreate

print('Content-type: Application/json\r\n')
print('\r\n')


class Xml2Json:
    LIST_TAGS = ['COMMANDS']
    
    def __init__(self, data = None):
        self._parser = ParserCreate()
        self._parser.StartElementHandler = self.start
        self._parser.EndElementHandler = self.end
        self._parser.CharacterDataHandler = self.data
        self.result = None
        if data:
            self.feed(data)
            self.close()
        
    def feed(self, data):
        self._stack = []
        self._data = ''
        self._parser.Parse(data, 0)

    def close(self):
        self._parser.Parse("", 1)
        del self._parser

    def start(self, tag, attrs):
        assert attrs == {}
        assert self._data.strip() == ''
        print "START", repr(tag)
        self._stack.append([tag])
        self._data = ''

    def end(self, tag):
        print "END", repr(tag)
        last_tag = self._stack.pop()
        assert last_tag[0] == tag
        if len(last_tag) == 1: #leaf
            data = self._data
        else:
            if tag not in Xml2Json.LIST_TAGS:
                # build a dict, repeating pairs get pushed into lists
                data = {}
                for k, v in last_tag[1:]:
                    if k not in data:
                        data[k] = v
                    else:
                        el = data[k]
                        if type(el) is not list:
                            data[k] = [el, v]
                        else:
                            el.append(v)
            else: #force into a list
                data = [{k:v} for k, v in last_tag[1:]]
        if self._stack:
            self._stack[-1].append((tag, data))
        else:
            self.result = {tag:data}
        self._data = ''

    def data(self, data):
        self._data = data



from_date=""
to_date = ""
alertlevel = ""
country = ""
population = ""
severity = ""
eventtype = ""

form = cgi.FieldStorage(keep_blank_values=1)
from_date = form.getvalue("from")
to_date = form.getvalue("to")
alertlevel = form.getvalue("alertlevel")
country = form.getvalue("country")
population = form.getvalue("population")
severity = form.getvalue("severity")
eventtype = form.getvalue("severity")

url = "http://www.gdacs.org/rss.aspx?profile=ARCHIVE"

if from_date is not None and from_date != "":
    url = url+"&from="+from_date
if to_date is not None and to_date != "":
    url = url+"&to="+to_date
if alertlevel is not None and alertlevel != "":
    url = url+"&alertlevel="+alertlevel
if country is not None and country != "":
    url = url+"&country="+country
if population is not None and population != "":
    url = url+"&population="
if severity is not None and severity != "":
    url = url+"&severity="+severity
if eventtype is not None and eventtype != eventtype:
    url = url+"&eventtype="+eventtype
    
r = requests.get(url)
print Xml2Json(r.content).result








# >>> Xml2Json('<doc><tag><subtag>data</subtag><t>data1</t><t>data2</t></tag></doc>').result
# {u'doc': {u'tag': {u'subtag': u'data', u't': [u'data1', u'data2']}}}    