#this is the python script for user to remove the files which uploaded

#error types:
#error code 0: the remove routine has been executed successfully
#error code 1: 

import sys
import os

class cleaner:
    error_code = 0
    
    def __init__(self):

        self.error_code = -1;
        
    def rm_related_files(self, file_name):

       os.system("rm -fR " + file_name + " &") 

def run(file_name):
    
    cl_obj = cleaner()

    if file_name is not None:
        cl_obj.error_code = 1
        return cl_obj.error_code
    else:
        cl_obj.rm_related_files(file_name)
        
if __name__ == "__main__":
    file_name = sys.argv[1]
    run(file_name)
