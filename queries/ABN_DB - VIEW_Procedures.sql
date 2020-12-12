
-- Display all procedure //testing purposes

SELECT 
  ROUTINE_NAME
FROM INFORMATION_SCHEMA.ROUTINES
WHERE ROUTINE_TYPE = 'PROCEDURE' AND ROUTINE_NAME LIKE 'VIEW%';

----------------------------------------------------------------

-- View All Active Posts Procedure
CREATE PROCEDURE [dbo].[VIEW_AllRecentPosts]
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[industryType]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [Employers].[employerID]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityMunicipality] AS [location]
	FROM [dbo].[JobPosts]
	INNER JOIN [dbo].[Employers] 
	ON [JobPosts].[employerID] = [Employers].[employerID]
	AND [jobPostFlag] = 1
	ORDER BY [dateCreated] DESC
;


-- View Limited Active Posts
CREATE PROCEDURE [dbo].[VIEW_LimitedRecentPosts]
	@offsetRows		INT,
	@fetchedRows	INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[industryType]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [Employers].[employerID]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityMunicipality] AS [location]
	FROM [dbo].[JobPosts]
	INNER JOIN [dbo].[Employers] 
	ON [JobPosts].[employerID] = [Employers].[employerID]
	AND [jobPostFlag] = 1
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;
;

EXEC 

-- View Job Details Procedure
CREATE PROCEDURE [dbo].[VIEW_JobDetails]
	@jobPostID	INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[industryType]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[dateModified]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [status]
		, [Employers].[employerID]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityMunicipality] AS [location]
		, [Employers].[contactNumber]
		, [Employers].[email]
		, [Employers].[website]
	FROM [dbo].[JobPosts]
	INNER JOIN [dbo].[Employers]
	ON [JobPosts].[employerID] = [Employers].[employerID]
	AND [JobPosts].[jobPostID] = @jobPostID AND [JobPosts].[jobPostFlag] = 1
;


-- View Employer Details Procedure
CREATE PROCEDURE [dbo].[VIEW_CompanyDetails]
	@employerID INT
AS
	SELECT
		  [employerID]
		, [companyName]
		, [description]
		, [street] + ', ' + [brgyDistrict] + ', ' + [cityMunicipality] AS [location]
		, [contactNumber]
		, [email]
		, [website]
	FROM [dbo].[Employers]
	WHERE [employerID] = @employerID
;


-- View Available Jobs
CREATE PROCEDURE [dbo].[VIEW_AvailableJobs]
	@employerID
AS
